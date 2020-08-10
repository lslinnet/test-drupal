<?php

namespace Drupal\tinyurl\Plugin\GraphQL\SchemaExtension;

use Drupal\graphql\GraphQL\ResolverBuilder;
use Drupal\graphql\GraphQL\ResolverRegistryInterface;
use Drupal\graphql\Plugin\GraphQL\SchemaExtension\SdlSchemaExtensionPluginBase;
/**
 * @SchemaExtension(
 *   id = "url_extension",
 *   name = "TinyUrl extension",
 *   description = "A simple url shortener node.",
 *   schema = "composable_extension"
 * )
 */
class UrlSchemaExtension extends SdlSchemaExtensionPluginBase {

  /**
   * {@inheritdoc}
   */
  public function registerResolvers(ResolverRegistryInterface $registry)
  {
    $builder = New ResolverBuilder();

    // First we add our top level Query based fields to the Schema.
    $this->addQueryFields($registry, $builder);
    // Next we add the Url entity specific fields to the schema.
    $this->addUrlFields($registry, $builder);
  }

  /**
   * @param \Drupal\graphql\GraphQL\ResolverRegistryInterface $registry
   * @param \Drupal\graphql\GraphQL\ResolverBuilder $builder
   */
  protected function addUrlFields(ResolverRegistryInterface $registry, ResolverBuilder $builder) {
    $registry->addFieldResolver('Url', 'id',
      $builder->produce('entity_id')
      ->map('entity', $builder->fromParent())
    );

    $registry->addFieldResolver('Url', 'slug',
      $builder->produce('property_path')
        ->map('type', $builder->fromValue('entity:node'))
        ->map('value', $builder->fromParent())
        ->map('path', $builder->fromValue('field_slug.value'))
    );

    $registry->addFieldResolver('Url', 'url',
      $builder->produce('property_path')
      ->map('type', $builder->fromValue('entity:node'))
        ->map('type', $builder->fromValue('entity:node'))
        ->map('value', $builder->fromParent())
        ->map('path', $builder->fromValue('field_url.uri'))
    );
  }

  /**
   * @param ResolverRegistryInterface $registry
   * @param ResolverBuilder $builder
   */
  protected function addQueryFields(ResolverRegistryInterface $registry, ResolverBuilder $builder) {
    $registry->addFieldResolver('Query', 'url',
      $builder->produce('entity_load')
      ->map('type', $builder->fromValue('node'))
      ->map('bundles', $builder->fromValue(['url']))
      ->map('id', $builder->fromArgument('id'))
    );
  }
}
