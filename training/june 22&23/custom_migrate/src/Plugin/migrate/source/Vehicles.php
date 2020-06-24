<?php
namespace Drupal\custom_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for the vehicles.
 *
 * @MigrateSource(
 *   id = "vehicles"
 * )
 */
class Vehicles extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('vehicles', 'd')
      ->fields('d', ['id', 'name', 'description']);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('Vehicle ID'),
      'name' => $this->t('Vehicle Name'),
      'description' => $this->t('Vehicle Description'),
      'models' => $this->t('Model of Vehicles'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'd',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $vehicles = $this->select('models', 'g')
      ->fields('g', ['id'])
      ->condition('vehicle_id', $row->getSourceProperty('id'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('models', $vehicles);
    return parent::prepareRow($row);
  }
}