<?php

declare(strict_types=1);

namespace Drupal\digitalia_field_person_name\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\digitalia_field_person_name\Plugin\Field\FieldType\PersonNameItem;

/**
 * Plugin implementation of the 'digitalia_field_person_name_default' formatter.
 *
 * @FieldFormatter(
 *   id = "digitalia_field_person_name_default",
 *   label = @Translation("Default"),
 *   field_types = {"digitalia_field_person_name"},
 * )
 */
final class PersonNameDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings(): array {
    return ['foo' => 'bar'] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state): array {
    $element['foo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Foo'),
      '#default_value' => $this->getSetting('foo'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(): array {
    return [
      $this->t('Foo: @foo', ['@foo' => $this->getSetting('foo')]),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];

    foreach ($items as $delta => $item) {

      if ($item->category) {
        $allowed_values = PersonNameItem::allowedCategoryValues();
        $element[$delta]['category'] = [
          '#type' => 'item',
          '#title' => $this->t('Category'),
          '#markup' => $allowed_values[$item->category],
        ];
      }

      if ($item->given_name) {
        $element[$delta]['given_name'] = [
          '#type' => 'item',
          '#title' => $this->t('Given name'),
          '#markup' => $item->given_name,
        ];
      }

      if ($item->family_name) {
        $element[$delta]['family_name'] = [
          '#type' => 'item',
          '#title' => $this->t('Family name'),
          '#markup' => $item->family_name,
        ];
      }

      if ($item->specification) {
        $element[$delta]['specification'] = [
          '#type' => 'item',
          '#title' => $this->t('Specification'),
          '#markup' => $item->specification,
        ];
      }

      if ($item->characteristics) {
        $allowed_values = PersonNameItem::allowedCharacteristicsValues();
        $element[$delta]['characteristics'] = [
          '#type' => 'item',
          '#title' => $this->t('Characteristics'),
          '#markup' => $allowed_values[$item->characteristics],
        ];
      }

      if ($item->type) {
        $allowed_values = PersonNameItem::allowedTypeValues();
        $element[$delta]['type'] = [
          '#type' => 'item',
          '#title' => $this->t('Type'),
          '#markup' => $allowed_values[$item->type],
        ];
      }

      if ($item->source) {
        $element[$delta]['source'] = [
          '#type' => 'item',
          '#title' => $this->t('Source'),
          '#markup' => $item->source,
        ];
      }

      if ($item->note) {
        $element[$delta]['note'] = [
          '#type' => 'item',
          '#title' => $this->t('Note'),
          '#markup' => $item->note,
        ];
      }

    }

    return $element;
  }

}
