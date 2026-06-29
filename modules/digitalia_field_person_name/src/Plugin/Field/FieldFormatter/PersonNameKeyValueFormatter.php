<?php

declare(strict_types=1);

namespace Drupal\digitalia_field_person_name\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\digitalia_field_person_name\Plugin\Field\FieldType\PersonNameItem;

/**
 * Plugin implementation of the 'digitalia_field_person_name_key_value' formatter.
 *
 * @FieldFormatter(
 *   id = "digitalia_field_person_name_key_value",
 *   label = @Translation("Key-value"),
 *   field_types = {"digitalia_field_person_name"},
 * )
 */
final class PersonNameKeyValueFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {

    $element = [];

    foreach ($items as $delta => $item) {
      $table = [
        '#type' => 'table',
      ];

      // Category.
      if ($item->category) {
        $allowed_values = PersonNameItem::allowedCategoryValues();

        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Category'),
              ],
            ],
            [
              'data' => [
                '#markup' => $allowed_values[$item->category],
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Given name.
      if ($item->given_name) {
        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Given name'),
              ],
            ],
            [
              'data' => [
                '#markup' => $item->given_name,
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Family name.
      if ($item->family_name) {
        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Family name'),
              ],
            ],
            [
              'data' => [
                '#markup' => $item->family_name,
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Specification.
      if ($item->specification) {
        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Specification'),
              ],
            ],
            [
              'data' => [
                '#markup' => $item->specification,
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Characteristics.
      if ($item->characteristics) {
        $allowed_values = PersonNameItem::allowedCharacteristicsValues();

        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Characteristics'),
              ],
            ],
            [
              'data' => [
                '#markup' => $allowed_values[$item->characteristics],
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Type.
      if ($item->type) {
        $allowed_values = PersonNameItem::allowedTypeValues();

        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Type'),
              ],
            ],
            [
              'data' => [
                '#markup' => $allowed_values[$item->type],
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Source.
      if ($item->source) {
        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Source'),
              ],
            ],
            [
              'data' => [
                '#markup' => $item->source,
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      // Note.
      if ($item->note) {
        $table['#rows'][] = [
          'data' => [
            [
              'header' => TRUE,
              'data' => [
                '#markup' => $this->t('Note'),
              ],
            ],
            [
              'data' => [
                '#markup' => $item->note,
              ],
            ],
          ],
          'no_striping' => TRUE,
        ];
      }

      $element[$delta] = $table;
    }

    return $element;
  }

}
