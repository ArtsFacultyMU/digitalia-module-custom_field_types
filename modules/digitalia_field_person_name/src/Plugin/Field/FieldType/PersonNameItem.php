<?php

declare(strict_types=1);

namespace Drupal\digitalia_field_person_name\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'digitalia_field_person_name' field type.
 *
 * @FieldType(
 *   id = "digitalia_field_person_name",
 *   label = @Translation("Person name"),
 *   description = @Translation("Some description."),
 *   default_widget = "digitalia_field_person_name",
 *   default_formatter = "digitalia_field_person_name_default",
 * )
 */
final class PersonNameItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public function isEmpty(): bool {
    return $this->category === NULL && $this->given_name === NULL && $this->family_name === NULL && $this->specification === NULL && $this->characteristics === NULL && $this->type === NULL && $this->source === NULL && $this->note === NULL;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition): array {

    $properties['category'] = DataDefinition::create('string')
      ->setLabel(t('Category'));
    $properties['given_name'] = DataDefinition::create('string')
      ->setLabel(t('Given name'));
    $properties['family_name'] = DataDefinition::create('string')
      ->setLabel(t('Family name'));
    $properties['specification'] = DataDefinition::create('string')
      ->setLabel(t('Specification'));
    $properties['characteristics'] = DataDefinition::create('string')
      ->setLabel(t('Characteristics'));
    $properties['type'] = DataDefinition::create('string')
      ->setLabel(t('Type'));
    $properties['source'] = DataDefinition::create('string')
      ->setLabel(t('Source'));
    $properties['note'] = DataDefinition::create('string')
      ->setLabel(t('Note'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $constraints = parent::getConstraints();

    $options['category']['AllowedValues'] = array_keys(PersonNameItem::allowedCategoryValues());

    $options['characteristics']['AllowedValues'] = array_keys(PersonNameItem::allowedCharacteristicsValues());

    $options['type']['AllowedValues'] = array_keys(PersonNameItem::allowedTypeValues());

    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints[] = $constraint_manager->create('ComplexData', $options);
    // @todo Add more constraints here.
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition): array {

    $columns = [
      'category' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'given_name' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'family_name' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'specification' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'characteristics' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'type' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'source' => [
        'type' => 'text',
        'size' => 'big',
      ],
      'note' => [
        'type' => 'text',
        'size' => 'big',
      ],
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition): array {

    $random = new Random();

    $values['category'] = array_rand(self::allowedCategoryValues());

    $values['given_name'] = $random->word(mt_rand(1, 255));

    $values['family_name'] = $random->word(mt_rand(1, 255));

    $values['specification'] = $random->word(mt_rand(1, 255));

    $values['characteristics'] = array_rand(self::allowedCharacteristicsValues());

    $values['type'] = array_rand(self::allowedTypeValues());

    $values['source'] = $random->paragraphs(5);

    $values['note'] = $random->paragraphs(5);

    return $values;
  }

  /**
   * Returns allowed values for 'category' sub-field.
   */
  public static function allowedCategoryValues(): array {
    // @todo Update allowed values.
    return [
      'preferred' => t('preferované jméno'),
      'variant' => t('variantní jméno'),
    ];
  }

  /**
   * Returns allowed values for 'characteristics' sub-field.
   */
  public static function allowedCharacteristicsValues(): array {
    // @todo Update allowed values.
    return [
      'novodobe' => t('novodobé jméno'),
      'prijmi' => t('příjmí'),
      'pridomek' => t('přídomek'),
    ];
  }

  /**
   * Returns allowed values for 'type' sub-field.
   */
  public static function allowedTypeValues(): array {
    // @todo Update allowed values.
    return [
      'vlastni_rodne' => t('vlastní/rodné jméno'),
      'umelecke' => t('umělecké jméno (pseudonym)'),
      'prijate' => t('přijaté jméno'),
      'vyvdane' => t('vyvdané jméno'),
      'radove' => t('řádové jméno'),
      'alternativni' => t('alternativní jméno'),
    ];
  }

}
