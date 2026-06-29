<?php

declare(strict_types=1);

namespace Drupal\digitalia_field_person_name\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\digitalia_field_person_name\Plugin\Field\FieldType\PersonNameItem;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Defines the 'digitalia_field_person_name' field widget.
 *
 * @FieldWidget(
 *   id = "digitalia_field_person_name",
 *   label = @Translation("Person name"),
 *   field_types = {"digitalia_field_person_name"},
 * )
 */
final class PersonNameWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state): array {

    $element['category'] = [
      '#type' => 'select',
      '#title' => $this->t('Category'),
      '#options' => ['' => $this->t('- None -')] + PersonNameItem::allowedCategoryValues(),
      '#default_value' => $items[$delta]->category ?? NULL,
    ];

    $element['given_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Given name'),
      '#default_value' => $items[$delta]->given_name ?? NULL,
    ];

    $element['family_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Family name'),
      '#default_value' => $items[$delta]->family_name ?? NULL,
    ];

    $element['specification'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Specification'),
      '#default_value' => $items[$delta]->specification ?? NULL,
    ];

    $element['characteristics'] = [
      '#type' => 'select',
      '#title' => $this->t('Characteristics'),
      '#options' => ['' => $this->t('- None -')] + PersonNameItem::allowedCharacteristicsValues(),
      '#default_value' => $items[$delta]->characteristics ?? NULL,
    ];

    $element['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#options' => ['' => $this->t('- None -')] + PersonNameItem::allowedTypeValues(),
      '#default_value' => $items[$delta]->type ?? NULL,
    ];

    $element['source'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Source'),
      '#default_value' => $items[$delta]->source ?? NULL,
    ];

    $element['note'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Note'),
      '#default_value' => $items[$delta]->note ?? NULL,
    ];

    $element['#theme_wrappers'] = ['container', 'form_element'];
    $element['#attributes']['class'][] = 'digitalia-field-person-name-elements';
    $element['#attached']['library'][] = 'digitalia_field_person_name/digitalia_field_person_name';

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function errorElement(array $element, ConstraintViolationInterface $error, array $form, FormStateInterface $form_state): array|bool {
    $element = parent::errorElement($element, $error, $form, $form_state);
    if ($element === FALSE) {
      return FALSE;
    }
    $error_property = explode('.', $error->getPropertyPath())[1];
    return $element[$error_property];
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state): array {
    foreach ($values as $delta => $value) {
      if ($value['category'] === '') {
        $values[$delta]['category'] = NULL;
      }
      if ($value['given_name'] === '') {
        $values[$delta]['given_name'] = NULL;
      }
      if ($value['family_name'] === '') {
        $values[$delta]['family_name'] = NULL;
      }
      if ($value['specification'] === '') {
        $values[$delta]['specification'] = NULL;
      }
      if ($value['characteristics'] === '') {
        $values[$delta]['characteristics'] = NULL;
      }
      if ($value['type'] === '') {
        $values[$delta]['type'] = NULL;
      }
      if ($value['source'] === '') {
        $values[$delta]['source'] = NULL;
      }
      if ($value['note'] === '') {
        $values[$delta]['note'] = NULL;
      }
    }
    return $values;
  }

}
