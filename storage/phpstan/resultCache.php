<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1771484961,
	'meta' => array (
  'cacheVersion' => 'v12-linesToIgnore',
  'phpstanVersion' => '2.1.39',
  'fnsr' => false,
  'metaExtensions' => 
  array (
  ),
  'phpVersion' => 80329,
  'projectConfig' => '{conditionalTags: {Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule: {phpstan.rules.rule: %noEnvCallsOutsideOfConfig%}, Larastan\\Larastan\\Rules\\NoModelMakeRule: {phpstan.rules.rule: %noModelMake%}, Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule: {phpstan.rules.rule: %noUnnecessaryCollectionCall%}, Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule: {phpstan.rules.rule: %noUnnecessaryEnumerableToArrayCalls%}, Larastan\\Larastan\\Rules\\OctaneCompatibilityRule: {phpstan.rules.rule: %checkOctaneCompatibility%}, Larastan\\Larastan\\Rules\\UnusedViewsRule: {phpstan.rules.rule: %checkUnusedViews%}, Larastan\\Larastan\\Rules\\NoMissingTranslationsRule: {phpstan.rules.rule: %checkMissingTranslations%}, Larastan\\Larastan\\Rules\\ModelAppendsRule: {phpstan.rules.rule: %checkModelAppends%}, Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule: {phpstan.rules.rule: %checkModelMethodVisibility%}, Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %generalizeEnvReturnType%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension: {phpstan.broker.dynamicMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension: {phpstan.broker.dynamicStaticMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\Rules\\ConfigCollectionRule: {phpstan.rules.rule: %checkConfigTypes%}}, parameters: {universalObjectCratesClasses: [Illuminate\\Http\\Request, Illuminate\\Support\\Optional], earlyTerminatingFunctionCalls: [abort, dd], mixinExcludeClasses: [Eloquent], bootstrapFiles: [bootstrap.php, bootstrap/app.php], checkOctaneCompatibility: false, noEnvCallsOutsideOfConfig: true, noModelMake: true, noUnnecessaryCollectionCall: true, noUnnecessaryCollectionCallOnly: [], noUnnecessaryCollectionCallExcept: [], noUnnecessaryEnumerableToArrayCalls: false, squashedMigrationsPath: [], databaseMigrationsPath: [], disableMigrationScan: false, disableSchemaScan: false, configDirectories: [], viewDirectories: [], translationDirectories: [], checkModelProperties: false, checkUnusedViews: false, checkMissingTranslations: false, checkModelAppends: true, checkModelMethodVisibility: false, generalizeEnvReturnType: false, checkConfigTypes: false, checkAuthCallsWhenInRequestScope: false, parseModelCastsMethod: false, enableMigrationCache: false, level: 6, paths: [/Users/fabionbaromeo/Herd/isb-presta-manager/app], tmpDir: /Users/fabionbaromeo/Herd/isb-presta-manager/storage/phpstan}, rules: [Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessWithFunctionCallsRule, Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessValueFunctionCallsRule, Larastan\\Larastan\\Rules\\DeferrableServiceProviderMissingProvidesRule, Larastan\\Larastan\\Rules\\ConsoleCommand\\UndefinedArgumentOrOptionRule], services: {{class: Larastan\\Larastan\\Methods\\RelationForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\EloquentBuilderForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderTapProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderCollectionProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\StorageMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\Extension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelFactoryMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\RedirectResponseMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\MacroMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ViewWithMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelAccessorExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\HigherOrderCollectionProxyPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\HigherOrderTapProxyExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\Properties\\ModelRelationsExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelOnlyDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelFactoryDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthManagerExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DateExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestFileExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestRouteExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestUserExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentBuilderExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RelationCollectionExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TestCaseExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Support\\CollectionHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AuthExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\CollectExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\NowAndTodayExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ResponseExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValidatorExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\LiteralExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionFilterRejectDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionWhereNotNullDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\NewModelQueryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\FactoryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: true}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: true}}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AppExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValueExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\StrExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\TapExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\StorageDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\GenericEloquentCollectionTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Types\\ViewStringTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Rules\\OctaneCompatibilityRule}, {class: Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule, arguments: {configDirectories: %configDirectories%}}, {class: Larastan\\Larastan\\Rules\\NoModelMakeRule}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule, arguments: {onlyMethods: %noUnnecessaryCollectionCallOnly%, excludeMethods: %noUnnecessaryCollectionCallExcept%}}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule}, {class: Larastan\\Larastan\\Rules\\ModelAppendsRule}, {class: Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule}, {class: Larastan\\Larastan\\Types\\GenericEloquentBuilderTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppFacadeEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\ModelProperty\\ModelPropertyTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension], arguments: {active: %checkModelProperties%}}, {class: Larastan\\Larastan\\Types\\CollectionOf\\CollectionOfTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Properties\\MigrationHelper, arguments: {databaseMigrationPath: %databaseMigrationsPath%, disableMigrationScan: %disableMigrationScan%, parser: @migrationsParser, reflectionProvider: @reflectionProvider}}, iamcalSqlParser: {class: Larastan\\Larastan\\SQL\\IamcalSqlParser, autowired: false}, sqlParserFactory: {class: Larastan\\Larastan\\SQL\\SqlParserFactory, arguments: {iamcalSqlParser: @iamcalSqlParser}}, sqlParser: {type: Larastan\\Larastan\\SQL\\SqlParser, factory: [@sqlParserFactory, create]}, {class: Larastan\\Larastan\\Properties\\SquashedMigrationHelper, arguments: {schemaPaths: %squashedMigrationsPath%, disableSchemaScan: %disableSchemaScan%}}, {class: Larastan\\Larastan\\Properties\\ModelCastHelper, arguments: {parser: @currentPhpVersionSimpleDirectParser, parseModelCastsMethod: %parseModelCastsMethod%}}, {class: Larastan\\Larastan\\Properties\\MigrationCache, arguments: {cacheDirectory: %tmpDir%, enabled: %enableMigrationCache%}}, {class: Larastan\\Larastan\\Properties\\ModelPropertyHelper}, {class: Larastan\\Larastan\\Rules\\ModelRuleHelper}, {class: Larastan\\Larastan\\Methods\\BuilderHelper, arguments: {checkProperties: %checkModelProperties%}}, {class: Larastan\\Larastan\\Rules\\RelationExistenceRule, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Bus\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Events\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Properties\\Schema\\MySqlDataTypeToPhpTypeConverter}, {class: Larastan\\Larastan\\LarastanStubFilesExtension, tags: [phpstan.stubFilesExtension]}, {class: Larastan\\Larastan\\Rules\\UnusedViewsRule}, {class: Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedEmailViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewFacadeMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedRouteFacadeViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewInAnotherViewCollector}, {class: Larastan\\Larastan\\Support\\ViewFileHelper, arguments: {viewDirectories: %viewDirectories%}}, {class: Larastan\\Larastan\\Support\\ViewParser, arguments: {parser: @currentPhpVersionSimpleDirectParser}}, {class: Larastan\\Larastan\\Rules\\NoMissingTranslationsRule, arguments: {translationDirectories: %translationDirectories%}}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationTranslatorCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFacadeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationViewCollector}, {class: Larastan\\Larastan\\ReturnTypes\\ApplicationMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\ArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\OptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasOptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TranslatorGetReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\LangGetReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TransHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DoubleUnderscoreHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeHelper}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationResolver}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationHelper}, {class: Larastan\\Larastan\\Support\\HigherOrderCollectionProxyHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension}, {class: Larastan\\Larastan\\Support\\ConfigParser, arguments: {parser: @currentPhpVersionSimpleDirectParser, configPaths: %configDirectories%}}, {class: Larastan\\Larastan\\Internal\\ConfigHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\FormRequestSafeDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\ConfigCollectionRule}, {class: Illuminate\\Filesystem\\Filesystem, autowired: self}, migrationsParser: {class: PHPStan\\Parser\\CachedParser, arguments: {originalParser: @currentPhpVersionSimpleDirectParser, cachedNodesByStringCountMax: %cache.nodesByStringCountMax%}, autowired: false}}}',
  'analysedPaths' => 
  array (
    0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app',
  ),
  'scannedFiles' => 
  array (
  ),
  'composerLocks' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/composer.lock' => '3f59304f0c2da370a164ec61d93be59e208a386a0e90622ef7d7d9b5f8c22f85',
  ),
  'composerInstalled' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'brianium/paratest' => 
        array (
          'pretty_version' => 'v7.19.0',
          'version' => '7.19.0.0',
          'reference' => '7c6c29af7c4b406b49ce0c6b0a3a81d3684474e6',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../brianium/paratest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'brick/math' => 
        array (
          'pretty_version' => '0.14.8',
          'version' => '0.14.8.0',
          'reference' => '63422359a44b7f06cae63c3b429b59e8efcc0629',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../brick/math',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'carbonphp/carbon-doctrine-types' => 
        array (
          'pretty_version' => '3.2.0',
          'version' => '3.2.0.0',
          'reference' => '18ba5ddfec8976260ead6e866180bd5d2f71aa1d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../carbonphp/carbon-doctrine-types',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'cordoval/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'davedevelopment/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'dflydev/dot-access-data' => 
        array (
          'pretty_version' => 'v3.0.3',
          'version' => '3.0.3.0',
          'reference' => 'a23a2bf4f31d3518f3ecb38660c95715dfead60f',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../dflydev/dot-access-data',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/deprecations' => 
        array (
          'pretty_version' => '1.1.6',
          'version' => '1.1.6.0',
          'reference' => 'd4fe3e6fd9bb9e72557a19674f44d8ac7db4c6ca',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../doctrine/deprecations',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'doctrine/inflector' => 
        array (
          'pretty_version' => '2.1.0',
          'version' => '2.1.0.0',
          'reference' => '6d6c96277ea252fc1304627204c3d5e6e15faa3b',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../doctrine/inflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/lexer' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => '31ad66abc0fc9e1a1f2d9bc6a42668d2fbbcd6dd',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../doctrine/lexer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dragonmantank/cron-expression' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => 'd61a8a9604ec1f8c3d150d09db6ce98b32675013',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../dragonmantank/cron-expression',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'egulias/email-validator' => 
        array (
          'pretty_version' => '4.0.4',
          'version' => '4.0.4.0',
          'reference' => 'd42c8731f0624ad6bdc8d3e5e9a4524f68801cfa',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../egulias/email-validator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'fakerphp/faker' => 
        array (
          'pretty_version' => 'v1.24.1',
          'version' => '1.24.1.0',
          'reference' => 'e0ee18eb1e6dc3cda3ce9fd97e5a0689a88a64b5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../fakerphp/faker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fidry/cpu-core-counter' => 
        array (
          'pretty_version' => '1.3.0',
          'version' => '1.3.0.0',
          'reference' => 'db9508f7b1474469d9d3c53b86f817e344732678',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../fidry/cpu-core-counter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'filp/whoops' => 
        array (
          'pretty_version' => '2.18.4',
          'version' => '2.18.4.0',
          'reference' => 'd2102955e48b9fd9ab24280a7ad12ed552752c4d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filp/whoops',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fruitcake/php-cors' => 
        array (
          'pretty_version' => 'v1.4.0',
          'version' => '1.4.0.0',
          'reference' => '38aaa6c3fd4c157ffe2a4d10aa8b9b16ba8de379',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../fruitcake/php-cors',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'graham-campbell/result-type' => 
        array (
          'pretty_version' => 'v1.1.4',
          'version' => '1.1.4.0',
          'reference' => 'e01f4a821471308ba86aa202fed6698b6b695e3b',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../graham-campbell/result-type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/guzzle' => 
        array (
          'pretty_version' => '7.10.0',
          'version' => '7.10.0.0',
          'reference' => 'b51ac707cfa420b7bfd4e4d5e510ba8008e822b4',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../guzzlehttp/guzzle',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/promises' => 
        array (
          'pretty_version' => '2.3.0',
          'version' => '2.3.0.0',
          'reference' => '481557b130ef3790cf82b713667b43030dc9c957',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../guzzlehttp/promises',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/psr7' => 
        array (
          'pretty_version' => '2.8.0',
          'version' => '2.8.0.0',
          'reference' => '21dc724a0583619cd1652f673303492272778051',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../guzzlehttp/psr7',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/uri-template' => 
        array (
          'pretty_version' => 'v1.0.5',
          'version' => '1.0.5.0',
          'reference' => '4f4bbd4e7172148801e76e3decc1e559bdee34e1',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../guzzlehttp/uri-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'hamcrest/hamcrest-php' => 
        array (
          'pretty_version' => 'v2.1.1',
          'version' => '2.1.1.0',
          'reference' => 'f8b1c0173b22fa6ec77a81fe63e5b01eba7e6487',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../hamcrest/hamcrest-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'iamcal/sql-parser' => 
        array (
          'pretty_version' => 'v0.7',
          'version' => '0.7.0.0',
          'reference' => '610392f38de49a44dab08dc1659960a29874c4b8',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../iamcal/sql-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'illuminate/auth' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/broadcasting' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/bus' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/cache' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/collections' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/concurrency' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/conditionable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/config' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/console' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/container' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/contracts' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/cookie' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/database' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/encryption' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/events' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/filesystem' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/hashing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/http' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/json-schema' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/log' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/macroable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/mail' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/notifications' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/pagination' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/pipeline' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/process' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/queue' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/redis' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/reflection' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/routing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/session' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/support' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/testing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/translation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/validation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'illuminate/view' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.52.0',
          ),
        ),
        'jean85/pretty-package-versions' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '4d7aa5dab42e2a76d99559706022885de0e18e1a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../jean85/pretty-package-versions',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'kodova/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'larastan/larastan' => 
        array (
          'pretty_version' => 'v3.9.2',
          'version' => '3.9.2.0',
          'reference' => '2e9ed291bdc1969e7f270fb33c9cdf3c912daeb2',
          'type' => 'phpstan-extension',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../larastan/larastan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/boost' => 
        array (
          'pretty_version' => 'v2.1.7',
          'version' => '2.1.7.0',
          'reference' => '3f999986f9dc0f1faa9a6607739e938d551e27df',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/boost',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/framework' => 
        array (
          'pretty_version' => 'v12.52.0',
          'version' => '12.52.0.0',
          'reference' => 'd5511fa74f4608dbb99864198b1954042aa8d5a7',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/framework',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/mcp' => 
        array (
          'pretty_version' => 'v0.5.9',
          'version' => '0.5.9.0',
          'reference' => '39e8da60eb7bce4737c5d868d35a3fe78938c129',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/mcp',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/pail' => 
        array (
          'pretty_version' => 'v1.2.6',
          'version' => '1.2.6.0',
          'reference' => 'aa71a01c309e7f66bc2ec4fb1a59291b82eb4abf',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/pail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/pint' => 
        array (
          'pretty_version' => 'v1.27.1',
          'version' => '1.27.1.0',
          'reference' => '54cca2de13790570c7b6f0f94f37896bee4abcb5',
          'type' => 'project',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/pint',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/prompts' => 
        array (
          'pretty_version' => 'v0.3.13',
          'version' => '0.3.13.0',
          'reference' => 'ed8c466571b37e977532fb2fd3c272c784d7050d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/prompts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/roster' => 
        array (
          'pretty_version' => 'v0.4.0',
          'version' => '0.4.0.0',
          'reference' => '77e6c1187952d0eef50a54922db47893f5e7c986',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/roster',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/sail' => 
        array (
          'pretty_version' => 'v1.53.0',
          'version' => '1.53.0.0',
          'reference' => 'e340eaa2bea9b99192570c48ed837155dbf24fbb',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/sail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/serializable-closure' => 
        array (
          'pretty_version' => 'v2.0.9',
          'version' => '2.0.9.0',
          'reference' => '8f631589ab07b7b52fead814965f5a800459cb3e',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/serializable-closure',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/tinker' => 
        array (
          'pretty_version' => 'v2.11.1',
          'version' => '2.11.1.0',
          'reference' => 'c9f80cc835649b5c1842898fb043f8cc098dd741',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/tinker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/commonmark' => 
        array (
          'pretty_version' => '2.8.0',
          'version' => '2.8.0.0',
          'reference' => '4efa10c1e56488e658d10adf7b7b7dcd19940bfb',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/commonmark',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/config' => 
        array (
          'pretty_version' => 'v1.2.0',
          'version' => '1.2.0.0',
          'reference' => '754b3604fb2984c71f4af4a9cbe7b57f346ec1f3',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/config',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem' => 
        array (
          'pretty_version' => '3.31.0',
          'version' => '3.31.0.0',
          'reference' => '1717e0b3642b0df65ecb0cc89cdd99fa840672ff',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/flysystem',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem-local' => 
        array (
          'pretty_version' => '3.31.0',
          'version' => '3.31.0.0',
          'reference' => '2f669db18a4c20c755c2bb7d3a7b0b2340488079',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/flysystem-local',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/mime-type-detection' => 
        array (
          'pretty_version' => '1.16.0',
          'version' => '1.16.0.0',
          'reference' => '2d6702ff215bf922936ccc1ad31007edc76451b9',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/mime-type-detection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri' => 
        array (
          'pretty_version' => '7.8.0',
          'version' => '7.8.0.0',
          'reference' => '4436c6ec8d458e4244448b069cc572d088230b76',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/uri',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri-interfaces' => 
        array (
          'pretty_version' => '7.8.0',
          'version' => '7.8.0.0',
          'reference' => 'c5c5cd056110fc8afaba29fa6b72a43ced42acd4',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/uri-interfaces',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mockery/mockery' => 
        array (
          'pretty_version' => '1.6.12',
          'version' => '1.6.12.0',
          'reference' => '1f4efdd7d3beafe9807b08156dfcb176d18f1699',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../mockery/mockery',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'monolog/monolog' => 
        array (
          'pretty_version' => '3.10.0',
          'version' => '3.10.0.0',
          'reference' => 'b321dd6749f0bf7189444158a3ce785cc16d69b0',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../monolog/monolog',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mtdowling/cron-expression' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '^1.0',
          ),
        ),
        'myclabs/deep-copy' => 
        array (
          'pretty_version' => '1.13.4',
          'version' => '1.13.4.0',
          'reference' => '07d290f0c47959fd5eed98c95ee5602db07e0b6a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../myclabs/deep-copy',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nesbot/carbon' => 
        array (
          'pretty_version' => '3.11.1',
          'version' => '3.11.1.0',
          'reference' => 'f438fcc98f92babee98381d399c65336f3a3827f',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nesbot/carbon',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/schema' => 
        array (
          'pretty_version' => 'v1.3.4',
          'version' => '1.3.4.0',
          'reference' => '086497a2f34b82fede9b5a41cc8e131d087cd8f7',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nette/schema',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/utils' => 
        array (
          'pretty_version' => 'v4.1.3',
          'version' => '4.1.3.0',
          'reference' => 'bb3ea637e3d131d72acc033cfc2746ee893349fe',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nette/utils',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nikic/php-parser' => 
        array (
          'pretty_version' => 'v5.7.0',
          'version' => '5.7.0.0',
          'reference' => 'dca41cd15c2ac9d055ad70dbfd011130757d1f82',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nikic/php-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nunomaduro/collision' => 
        array (
          'pretty_version' => 'v8.9.1',
          'version' => '8.9.1.0',
          'reference' => 'a1ed3fa530fd60bc515f9303e8520fcb7d4bd935',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nunomaduro/collision',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nunomaduro/termwind' => 
        array (
          'pretty_version' => 'v2.4.0',
          'version' => '2.4.0.0',
          'reference' => '712a31b768f5daea284c2169a7d227031001b9a8',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nunomaduro/termwind',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'pestphp/pest' => 
        array (
          'pretty_version' => 'v4.4.1',
          'version' => '4.4.1.0',
          'reference' => 'f96a1b27864b585b0b29b0ee7331176726f7e54a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pestphp/pest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin' => 
        array (
          'pretty_version' => 'v4.0.0',
          'version' => '4.0.0.0',
          'reference' => '9d4b93d7f73d3f9c3189bb22c220fef271cdf568',
          'type' => 'composer-plugin',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pestphp/pest-plugin',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-arch' => 
        array (
          'pretty_version' => 'v4.0.0',
          'version' => '4.0.0.0',
          'reference' => '25bb17e37920ccc35cbbcda3b00d596aadf3e58d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pestphp/pest-plugin-arch',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-laravel' => 
        array (
          'pretty_version' => 'v4.0.0',
          'version' => '4.0.0.0',
          'reference' => 'e12a07046b826a40b1c8632fd7b80d6b8d7b628e',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pestphp/pest-plugin-laravel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-mutate' => 
        array (
          'pretty_version' => 'v4.0.1',
          'version' => '4.0.1.0',
          'reference' => 'd9b32b60b2385e1688a68cc227594738ec26d96c',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pestphp/pest-plugin-mutate',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-profanity' => 
        array (
          'pretty_version' => 'v4.2.1',
          'version' => '4.2.1.0',
          'reference' => '343cfa6f3564b7e35df0ebb77b7fa97039f72b27',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pestphp/pest-plugin-profanity',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phar-io/manifest' => 
        array (
          'pretty_version' => '2.0.4',
          'version' => '2.0.4.0',
          'reference' => '54750ef60c58e43759730615a392c31c80e23176',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phar-io/manifest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phar-io/version' => 
        array (
          'pretty_version' => '3.2.1',
          'version' => '3.2.1.0',
          'reference' => '4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phar-io/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/reflection-common' => 
        array (
          'pretty_version' => '2.2.0',
          'version' => '2.2.0.0',
          'reference' => '1d01c49d4ed62f25aa84a747ad35d5a16924662b',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpdocumentor/reflection-common',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/reflection-docblock' => 
        array (
          'pretty_version' => '5.6.6',
          'version' => '5.6.6.0',
          'reference' => '5cee1d3dfc2d2aa6599834520911d246f656bcb8',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpdocumentor/reflection-docblock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/type-resolver' => 
        array (
          'pretty_version' => '1.12.0',
          'version' => '1.12.0.0',
          'reference' => '92a98ada2b93d9b201a613cb5a33584dde25f195',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpdocumentor/type-resolver',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpoption/phpoption' => 
        array (
          'pretty_version' => '1.9.5',
          'version' => '1.9.5.0',
          'reference' => '75365b91986c2405cf5e1e012c5595cd487a98be',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpoption/phpoption',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpstan/phpdoc-parser' => 
        array (
          'pretty_version' => '2.3.2',
          'version' => '2.3.2.0',
          'reference' => 'a004701b11273a26cd7955a61d67a7f1e525a45a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpstan/phpdoc-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpstan/phpstan' => 
        array (
          'pretty_version' => '2.1.39',
          'version' => '2.1.39.0',
          'reference' => 'c6f73a2af4cbcd99c931d0fb8f08548cc0fa8224',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpstan/phpstan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-code-coverage' => 
        array (
          'pretty_version' => '12.5.3',
          'version' => '12.5.3.0',
          'reference' => 'b015312f28dd75b75d3422ca37dff2cd1a565e8d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpunit/php-code-coverage',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-file-iterator' => 
        array (
          'pretty_version' => '6.0.1',
          'version' => '6.0.1.0',
          'reference' => '3d1cd096ef6bea4bf2762ba586e35dbd317cbfd5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpunit/php-file-iterator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-invoker' => 
        array (
          'pretty_version' => '6.0.0',
          'version' => '6.0.0.0',
          'reference' => '12b54e689b07a25a9b41e57736dfab6ec9ae5406',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpunit/php-invoker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-text-template' => 
        array (
          'pretty_version' => '5.0.0',
          'version' => '5.0.0.0',
          'reference' => 'e1367a453f0eda562eedb4f659e13aa900d66c53',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpunit/php-text-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-timer' => 
        array (
          'pretty_version' => '8.0.0',
          'version' => '8.0.0.0',
          'reference' => 'f258ce36aa457f3aa3339f9ed4c81fc66dc8c2cc',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpunit/php-timer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/phpunit' => 
        array (
          'pretty_version' => '12.5.12',
          'version' => '12.5.12.0',
          'reference' => '418e06b3b46b0d54bad749ff4907fc7dfb530199',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpunit/phpunit',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'psr/clock' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'e41a24703d4560fd0acb709162f73b8adfc3aa0d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/clock-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/container' => 
        array (
          'pretty_version' => '2.0.2',
          'version' => '2.0.2.0',
          'reference' => 'c71ecc56dfe541dbd90c5360474fbc405f8d5963',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/container',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/container-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.1|2.0',
          ),
        ),
        'psr/event-dispatcher' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-client' => 
        array (
          'pretty_version' => '1.0.3',
          'version' => '1.0.3.0',
          'reference' => 'bb5906edc1c324c9a05aa0873d40117941e5fa90',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/http-client',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-factory' => 
        array (
          'pretty_version' => '1.1.0',
          'version' => '1.1.0.0',
          'reference' => '2b4765fddfe3b508ac62f829e852b1501d3f6e8a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/http-factory',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-factory-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-message' => 
        array (
          'pretty_version' => '2.0',
          'version' => '2.0.0.0',
          'reference' => '402d35bcb92c70c026d1a6a9883f06b2ead23d71',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/http-message',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-message-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/log' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => 'f16e1d5863e37f8d8c2a01719f5b34baa2b714d3',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/log',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/log-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
            1 => '3.0.0',
          ),
        ),
        'psr/simple-cache' => 
        array (
          'pretty_version' => '3.0.0',
          'version' => '3.0.0.0',
          'reference' => '764e0b3939f5ca87cb904f570ef9be2d78a07865',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psr/simple-cache',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/simple-cache-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
          ),
        ),
        'psy/psysh' => 
        array (
          'pretty_version' => 'v0.12.20',
          'version' => '0.12.20.0',
          'reference' => '19678eb6b952a03b8a1d96ecee9edba518bb0373',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../psy/psysh',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ralouphie/getallheaders' => 
        array (
          'pretty_version' => '3.0.3',
          'version' => '3.0.3.0',
          'reference' => '120b605dfeb996808c31b6477290a714d356e822',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../ralouphie/getallheaders',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/collection' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '344572933ad0181accbf4ba763e85a0306a8c5e2',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../ramsey/collection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/uuid' => 
        array (
          'pretty_version' => '4.9.2',
          'version' => '4.9.2.0',
          'reference' => '8429c78ca35a09f27565311b98101e2826affde0',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../ramsey/uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'rhumsaa/uuid' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '4.9.2',
          ),
        ),
        'sebastian/cli-parser' => 
        array (
          'pretty_version' => '4.2.0',
          'version' => '4.2.0.0',
          'reference' => '90f41072d220e5c40df6e8635f5dafba2d9d4d04',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/cli-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/comparator' => 
        array (
          'pretty_version' => '7.1.4',
          'version' => '7.1.4.0',
          'reference' => '6a7de5df2e094f9a80b40a522391a7e6022df5f6',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/comparator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/complexity' => 
        array (
          'pretty_version' => '5.0.0',
          'version' => '5.0.0.0',
          'reference' => 'bad4316aba5303d0221f43f8cee37eb58d384bbb',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/complexity',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/diff' => 
        array (
          'pretty_version' => '7.0.0',
          'version' => '7.0.0.0',
          'reference' => '7ab1ea946c012266ca32390913653d844ecd085f',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/diff',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/environment' => 
        array (
          'pretty_version' => '8.0.3',
          'version' => '8.0.3.0',
          'reference' => '24a711b5c916efc6d6e62aa65aa2ec98fef77f68',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/environment',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/exporter' => 
        array (
          'pretty_version' => '7.0.2',
          'version' => '7.0.2.0',
          'reference' => '016951ae10980765e4e7aee491eb288c64e505b7',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/exporter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/global-state' => 
        array (
          'pretty_version' => '8.0.2',
          'version' => '8.0.2.0',
          'reference' => 'ef1377171613d09edd25b7816f05be8313f9115d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/global-state',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/lines-of-code' => 
        array (
          'pretty_version' => '4.0.0',
          'version' => '4.0.0.0',
          'reference' => '97ffee3bcfb5805568d6af7f0f893678fc076d2f',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/lines-of-code',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-enumerator' => 
        array (
          'pretty_version' => '7.0.0',
          'version' => '7.0.0.0',
          'reference' => '1effe8e9b8e068e9ae228e542d5d11b5d16db894',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/object-enumerator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-reflector' => 
        array (
          'pretty_version' => '5.0.0',
          'version' => '5.0.0.0',
          'reference' => '4bfa827c969c98be1e527abd576533293c634f6a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/object-reflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/recursion-context' => 
        array (
          'pretty_version' => '7.0.1',
          'version' => '7.0.1.0',
          'reference' => '0b01998a7d5b1f122911a66bebcb8d46f0c82d8c',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/recursion-context',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/type' => 
        array (
          'pretty_version' => '6.0.3',
          'version' => '6.0.3.0',
          'reference' => 'e549163b9760b8f71f191651d22acf32d56d6d4d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/version' => 
        array (
          'pretty_version' => '6.0.0',
          'version' => '6.0.0.0',
          'reference' => '3e6ccf7657d4f0a59200564b08cead899313b53c',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../sebastian/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'spatie/once' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'staabm/side-effects-detector' => 
        array (
          'pretty_version' => '1.0.5',
          'version' => '1.0.5.0',
          'reference' => 'd8334211a140ce329c13726d4a715adbddd0a163',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../staabm/side-effects-detector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'symfony/clock' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '9169f24776edde469914c1e7a1442a50f7a4e110',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/console' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '41e38717ac1dd7a46b6bda7d6a82af2d98a78894',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/console',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/css-selector' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => 'ab862f478513e7ca2fe9ec117a6f01a8da6e1135',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/css-selector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/deprecation-contracts' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => '63afe740e99a13ba87ec199bb07bbdee937a5b62',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/deprecation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/error-handler' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '8da531f364ddfee53e36092a7eebbbd0b775f6b8',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/error-handler',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => 'dc2c0eba1af673e736bb851d747d266108aea746',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-contracts' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => '59eb412e93815df44f05f342958efa9f46b1e586',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/event-dispatcher-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.0|3.0',
          ),
        ),
        'symfony/finder' => 
        array (
          'pretty_version' => 'v7.4.5',
          'version' => '7.4.5.0',
          'reference' => 'ad4daa7c38668dcb031e63bc99ea9bd42196a2cb',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/finder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-foundation' => 
        array (
          'pretty_version' => 'v7.4.5',
          'version' => '7.4.5.0',
          'reference' => '446d0db2b1f21575f1284b74533e425096abdfb6',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/http-foundation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-kernel' => 
        array (
          'pretty_version' => 'v7.4.5',
          'version' => '7.4.5.0',
          'reference' => '229eda477017f92bd2ce7615d06222ec0c19e82a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/http-kernel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mailer' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '7b750074c40c694ceb34cb926d6dffee231c5cd6',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/mailer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mime' => 
        array (
          'pretty_version' => 'v7.4.5',
          'version' => '7.4.5.0',
          'reference' => 'b18c7e6e9eee1e19958138df10412f3c4c316148',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/mime',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-ctype' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => 'a3cc8b044a6ea513310cbd48ef7333b384945638',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-ctype',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-grapheme' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '380872130d3a5dd3ace2f4010d95125fde5d5c70',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-intl-grapheme',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-idn' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '9614ac4d8061dc257ecc64cba1b140873dce8ad3',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-intl-idn',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-normalizer' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '3833d7255cc303546435cb650316bff708a1c75c',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-intl-normalizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-mbstring' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '6d857f4d76bd4b343eac26d6b539585d2bc56493',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-mbstring',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php80' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '0cc9dd0f17f61d8131e7df6b84bd344899fe2608',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-php80',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php83' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '17f6f9a6b1735c0f163024d959f700cfbc5155e5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-php83',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php84' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => 'd8ced4d875142b6a7426000426b8abc631d6b191',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-php84',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php85' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => 'd4e5fcd4ab3d998ab16c0db48e6cbb9a01993f91',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-php85',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-uuid' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '21533be36c24be3f4b1669c4725c7d1d2bab4ae2',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/polyfill-uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/process' => 
        array (
          'pretty_version' => 'v7.4.5',
          'version' => '7.4.5.0',
          'reference' => '608476f4604102976d687c483ac63a79ba18cc97',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/process',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/routing' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '0798827fe2c79caeed41d70b680c2c3507d10147',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/routing',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/service-contracts' => 
        array (
          'pretty_version' => 'v3.6.1',
          'version' => '3.6.1.0',
          'reference' => '45112560a3ba2d715666a509a0bc9521d10b6c43',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/service-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/string' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '1c4b10461bf2ec27537b5f36105337262f5f5d6f',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/string',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => 'bfde13711f53f549e73b06d27b35a55207528877',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/translation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-contracts' => 
        array (
          'pretty_version' => 'v3.6.1',
          'version' => '3.6.1.0',
          'reference' => '65a8bc82080447fae78373aa10f8d13b38338977',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/translation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.3|3.0',
          ),
        ),
        'symfony/uid' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '7719ce8aba76be93dfe249192f1fbfa52c588e36',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/uid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/var-dumper' => 
        array (
          'pretty_version' => 'v7.4.4',
          'version' => '7.4.4.0',
          'reference' => '0e4769b46a0c3c62390d124635ce59f66874b282',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/var-dumper',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/yaml' => 
        array (
          'pretty_version' => 'v7.4.1',
          'version' => '7.4.1.0',
          'reference' => '24dd4de28d2e3988b311751ac49e684d783e2345',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/yaml',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'ta-tikoma/phpunit-architecture-test' => 
        array (
          'pretty_version' => '0.8.7',
          'version' => '0.8.7.0',
          'reference' => '1248f3f506ca9641d4f68cebcd538fa489754db8',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../ta-tikoma/phpunit-architecture-test',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'theseer/tokenizer' => 
        array (
          'pretty_version' => '2.0.1',
          'version' => '2.0.1.0',
          'reference' => '7989e43bf381af0eac72e4f0ca5bcbfa81658be4',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../theseer/tokenizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'tijsverkoyen/css-to-inline-styles' => 
        array (
          'pretty_version' => 'v2.4.0',
          'version' => '2.4.0.0',
          'reference' => 'f0292ccf0ec75843d65027214426b6b163b48b41',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../tijsverkoyen/css-to-inline-styles',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'vlucas/phpdotenv' => 
        array (
          'pretty_version' => 'v5.6.3',
          'version' => '5.6.3.0',
          'reference' => '955e7815d677a3eaa7075231212f2110983adecc',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../vlucas/phpdotenv',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'voku/portable-ascii' => 
        array (
          'pretty_version' => '2.0.3',
          'version' => '2.0.3.0',
          'reference' => 'b1d923f88091c6bf09699efcd7c8a1b1bfd7351d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../voku/portable-ascii',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'webmozart/assert' => 
        array (
          'pretty_version' => '2.1.5',
          'version' => '2.1.5.0',
          'reference' => '79155f94852fa27e2f73b459f6503f5e87e2c188',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../webmozart/assert',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
      ),
    ),
  ),
  'executedFilesHashes' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/bootstrap/app.php' => '262d5870c4c5ee6e8c647ca3292ae41b313d42745e85a3b8ce6d237be86a7e44',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/larastan/larastan/bootstrap.php' => '5a3eacbf63b3e41659adfee92facededf8e020a932800f93c9a8b0e67f235805',
    'phar:///Users/fabionbaromeo/Herd/isb-presta-manager/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/Attribute85.php' => 'cb8b31e82c61ce197871c9e8a6f122256751f2ab606dd2be90846d4fa5f8933e',
    'phar:///Users/fabionbaromeo/Herd/isb-presta-manager/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionAttribute.php' => 'c0068e383717870a304781d462f7e2afe1c6f24e9133851852a2aca96b4fa26f',
    'phar:///Users/fabionbaromeo/Herd/isb-presta-manager/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionIntersectionType.php' => '65fe0a8bc6fe285d8ddc8798ab5b9299920af70db5ad74596bc08df823e7c5d9',
    'phar:///Users/fabionbaromeo/Herd/isb-presta-manager/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionUnionType.php' => '1e2fe940e4ba4e00d9ee6adb2af3ee1bf333e6f8afe61c61deb038886d293427',
  ),
  'phpExtensions' => 
  array (
    0 => 'Core',
    1 => 'FFI',
    2 => 'PDO',
    3 => 'Phar',
    4 => 'Reflection',
    5 => 'SPL',
    6 => 'SimpleXML',
    7 => 'Zend OPcache',
    8 => 'bcmath',
    9 => 'bz2',
    10 => 'calendar',
    11 => 'ctype',
    12 => 'curl',
    13 => 'date',
    14 => 'dba',
    15 => 'dom',
    16 => 'exif',
    17 => 'fileinfo',
    18 => 'filter',
    19 => 'ftp',
    20 => 'gd',
    21 => 'gettext',
    22 => 'gmp',
    23 => 'hash',
    24 => 'herd',
    25 => 'iconv',
    26 => 'igbinary',
    27 => 'imagick',
    28 => 'imap',
    29 => 'intl',
    30 => 'json',
    31 => 'ldap',
    32 => 'libxml',
    33 => 'mbstring',
    34 => 'mongodb',
    35 => 'mysqli',
    36 => 'mysqlnd',
    37 => 'openssl',
    38 => 'pcntl',
    39 => 'pcre',
    40 => 'pdo_mysql',
    41 => 'pdo_pgsql',
    42 => 'pdo_sqlite',
    43 => 'pdo_sqlsrv',
    44 => 'pgsql',
    45 => 'posix',
    46 => 'random',
    47 => 'readline',
    48 => 'redis',
    49 => 'session',
    50 => 'shmop',
    51 => 'soap',
    52 => 'sockets',
    53 => 'sodium',
    54 => 'sqlite3',
    55 => 'sqlsrv',
    56 => 'standard',
    57 => 'sysvmsg',
    58 => 'sysvsem',
    59 => 'sysvshm',
    60 => 'tokenizer',
    61 => 'xml',
    62 => 'xmlreader',
    63 => 'xmlwriter',
    64 => 'xsl',
    65 => 'zip',
    66 => 'zlib',
    67 => 'zstd',
  ),
  'stubFiles' => 
  array (
  ),
  'level' => '6',
),
	'projectExtensionFiles' => array (
),
	'errorsCallback' => static function (): array { return array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/Dashboard.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Pages\\Dashboard extends unknown class Filament\\Pages\\Dashboard.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/Dashboard.php',
       'line' => 7,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/Dashboard.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 7,
       'nodeType' => 'PhpParser\\Node\\Stmt\\Class_',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Pages\\TenantSettings extends unknown class Filament\\Pages\\Page.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 18,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 18,
       'nodeType' => 'PhpParser\\Node\\Stmt\\Class_',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Pages\\TenantSettings implements unknown interface Filament\\Forms\\Contracts\\HasForms.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 18,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 18,
       'nodeType' => 'PhpParser\\Node\\Stmt\\Class_',
       'identifier' => 'interface.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Pages\\TenantSettings uses unknown trait Filament\\Forms\\Concerns\\InteractsWithForms.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 20,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 20,
       'nodeType' => 'PhpParser\\Node\\Stmt\\TraitUse',
       'identifier' => 'trait.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Filament\\Saas\\Pages\\TenantSettings::$form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 41,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 41,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    4 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Pages\\TenantSettings::form() has invalid return type Filament\\Forms\\Form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 66,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 66,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    5 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Parameter $form of method App\\Filament\\Saas\\Pages\\TenantSettings::form() has invalid type Filament\\Forms\\Form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 66,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 66,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    6 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to method statePath() on an unknown class Filament\\Forms\\Form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 68,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 68,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    7 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 71,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 71,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    8 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 75,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 75,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    9 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 81,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 81,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    10 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 85,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 85,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    11 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 89,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 89,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    12 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 96,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 96,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    13 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 100,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 100,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    14 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Pages\\TenantSettings::getHeaderActions() has invalid return type Filament\\Actions\\Action.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 110,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 110,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    15 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Actions\\Action.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 113,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 113,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    16 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 132,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 132,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    17 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Actions\\Action.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 137,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 137,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    18 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Filament\\Saas\\Pages\\TenantSettings::$form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 158,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 158,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    19 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 160,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 160,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    20 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Filament\\Saas\\Pages\\TenantSettings::$form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 192,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 192,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    21 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Filament\\Saas\\Pages\\TenantSettings::$form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 211,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 211,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    22 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 214,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 214,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    23 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 223,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 223,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    24 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Filament\\Saas\\Pages\\TenantSettings::$form.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'line' => 246,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 246,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts extends unknown class Filament\\Resources\\Pages\\ListRecords.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php',
       'line' => 8,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 8,
       'nodeType' => 'PhpParser\\Node\\Stmt\\Class_',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts::getHeaderActions() return type has no value type specified in iterable type array.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php',
       'line' => 12,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php',
       'traitFilePath' => NULL,
       'tip' => 'See: https://phpstan.org/blog/solving-phpstan-no-value-type-specified-in-iterable-type',
       'nodeLine' => 12,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.iterableValue',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct extends unknown class Filament\\Resources\\Pages\\ViewRecord.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 13,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 13,
       'nodeType' => 'PhpParser\\Node\\Stmt\\Class_',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct::getHeaderActions() return type has no value type specified in iterable type array.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 17,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'See: https://phpstan.org/blog/solving-phpstan-no-value-type-specified-in-iterable-type',
       'nodeLine' => 17,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.iterableValue',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Actions\\Action.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 20,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 20,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 23,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 23,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    4 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to an undefined method App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct::getRecord().',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 33,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 33,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'method.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    5 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 39,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 39,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    6 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 44,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 44,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    7 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Actions\\Action.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 51,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 51,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    8 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Forms\\Components\\TextInput.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 54,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 54,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    9 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to an undefined method App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct::getRecord().',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 64,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 64,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'method.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    10 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 70,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 70,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    11 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Notifications\\Notification.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 75,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 75,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    12 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to an undefined method App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct::getRecord().',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 88,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 88,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'method.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    13 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct::$record.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'line' => 92,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 92,
       'nodeType' => 'PHPStan\\Node\\PropertyAssignNode',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Filament\\Saas\\Resources\\Products\\ProductResource extends unknown class Filament\\Resources\\Resource.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 24,
       'canBeIgnored' => false,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 24,
       'nodeType' => 'PhpParser\\Node\\Stmt\\Class_',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\ProductResource::canView() has parameter $record with no type specified.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 52,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 52,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.parameter',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\ProductResource::canEdit() has parameter $record with no type specified.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 62,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 62,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.parameter',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\ProductResource::canDelete() has parameter $record with no type specified.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 67,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 67,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.parameter',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    4 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\ProductResource::table() has invalid return type Filament\\Tables\\Table.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 72,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 72,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    5 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Parameter $table of method App\\Filament\\Saas\\Resources\\Products\\ProductResource::table() has invalid type Filament\\Tables\\Table.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 72,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 72,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    6 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to method searchPlaceholder() on an unknown class Filament\\Tables\\Table.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 74,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 74,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    7 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 77,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 77,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    8 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 80,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 80,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    9 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 84,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 84,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    10 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 87,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 87,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    11 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\IconColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 90,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 90,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    12 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 93,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 93,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    13 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 98,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 98,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    14 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 103,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 103,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    15 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 108,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 108,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    16 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Columns\\TextColumn.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 114,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 114,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    17 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Tables\\Actions\\ViewAction.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 122,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 122,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    18 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\ProductResource::infolist() has invalid return type Filament\\Infolists\\Infolist.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 129,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 129,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    19 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Parameter $infolist of method App\\Filament\\Saas\\Resources\\Products\\ProductResource::infolist() has invalid type Filament\\Infolists\\Infolist.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 129,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 129,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    20 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to method schema() on an unknown class Filament\\Infolists\\Infolist.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 131,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 131,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    21 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\Section.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 133,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 133,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    22 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 136,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 136,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    23 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 138,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 138,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    24 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 140,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 140,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    25 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 142,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 142,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    26 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 144,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 144,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    27 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 153,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 153,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    28 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\Section.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 157,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 157,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    29 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 160,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 160,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    30 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 163,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 163,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    31 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 166,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 166,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    32 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to static method make() on an unknown class Filament\\Infolists\\Components\\TextEntry.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 169,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more at https://phpstan.org/user-guide/discovering-symbols',
       'nodeLine' => 169,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    33 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to an undefined static method App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts::route().',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 182,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 182,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'staticMethod.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    34 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to an undefined static method App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct::route().',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 183,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 183,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'staticMethod.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    35 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Filament\\Saas\\Resources\\Products\\ProductResource::getEloquentQuery() return type with generic class Illuminate\\Database\\Eloquent\\Builder does not specify its types: TModel',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 187,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 187,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    36 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource::getEloquentQuery() calls parent::getEloquentQuery() but App\\Filament\\Saas\\Resources\\Products\\ProductResource does not extend any class.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 229,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 229,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'class.noParent',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    37 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Unsafe call to private method App\\Filament\\Saas\\Resources\\Products\\ProductResource::resolveSearchQuery() through static::.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 245,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 245,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'staticClassAccess.privateMethod',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    38 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Unsafe call to private method App\\Filament\\Saas\\Resources\\Products\\ProductResource::resolveTypeSenseProductIds() through static::.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 251,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 251,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'staticClassAccess.privateMethod',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    39 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Offset \'data\' on array{data: array<int, array<string, mixed>>, total: int} on left side of ?? always exists and is not nullable.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'line' => 300,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 300,
       'nodeType' => 'PhpParser\\Node\\Expr\\BinaryOp\\Coalesce',
       'identifier' => 'nullCoalesce.offset',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Models\\ApiToken uses generic trait Illuminate\\Database\\Eloquent\\Factories\\HasFactory but does not specify its types: TFactory',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php',
       'line' => 12,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 12,
       'nodeType' => 'PhpParser\\Node\\Stmt\\TraitUse',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Models\\AuditLog uses generic trait Illuminate\\Database\\Eloquent\\Factories\\HasFactory but does not specify its types: TFactory',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php',
       'line' => 11,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 11,
       'nodeType' => 'PhpParser\\Node\\Stmt\\TraitUse',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Models\\Job uses generic trait Illuminate\\Database\\Eloquent\\Factories\\HasFactory but does not specify its types: TFactory',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php',
       'line' => 11,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 11,
       'nodeType' => 'PhpParser\\Node\\Stmt\\TraitUse',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Models\\Revision uses generic trait Illuminate\\Database\\Eloquent\\Factories\\HasFactory but does not specify its types: TFactory',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php',
       'line' => 11,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 11,
       'nodeType' => 'PhpParser\\Node\\Stmt\\TraitUse',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Class App\\Models\\Tenant uses generic trait Illuminate\\Database\\Eloquent\\Factories\\HasFactory but does not specify its types: TFactory',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
       'line' => 12,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 12,
       'nodeType' => 'PhpParser\\Node\\Stmt\\TraitUse',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Method App\\Models\\Tenant::dbPasswordEncrypted() return type with generic class Illuminate\\Database\\Eloquent\\Casts\\Attribute does not specify its types: TGet, TSet',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
       'line' => 50,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 50,
       'nodeType' => 'PHPStan\\Node\\InClassMethodNode',
       'identifier' => 'missingType.generics',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Using nullsafe property access "?->db_prefix" on left side of ?? is unnecessary. Use -> instead.',
       'file' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php',
       'line' => 60,
       'canBeIgnored' => true,
       'filePath' => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 60,
       'nodeType' => 'PhpParser\\Node\\Expr\\BinaryOp\\Coalesce',
       'identifier' => 'nullsafe.neverNull',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
); },
	'locallyIgnoredErrorsCallback' => static function (): array { return array (
); },
	'linesToIgnore' => array (
),
	'unmatchedLineIgnores' => array (
),
	'collectedDataCallback' => static function (): array { return array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/Dashboard.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.pages.dashboard.navigation_label',
        1 => 13,
      ),
      1 => 
      array (
        0 => 'saas.pages.dashboard.title',
        1 => 18,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.pages.tenant_settings.navigation_label',
        1 => 58,
      ),
      1 => 
      array (
        0 => 'saas.pages.tenant_settings.title',
        1 => 63,
      ),
      2 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.db_host',
        1 => 72,
      ),
      3 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.db_port',
        1 => 76,
      ),
      4 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.db_name',
        1 => 82,
      ),
      5 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.db_user',
        1 => 86,
      ),
      6 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.db_password',
        1 => 90,
      ),
      7 => 
      array (
        0 => 'saas.pages.tenant_settings.password_hint',
        1 => 94,
      ),
      8 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.db_prefix',
        1 => 97,
      ),
      9 => 
      array (
        0 => 'saas.pages.tenant_settings.fields.base_shop_url',
        1 => 101,
      ),
      10 => 
      array (
        0 => 'saas.pages.tenant_settings.actions.test_connection',
        1 => 114,
      ),
      11 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.no_tenant',
        1 => 119,
      ),
      12 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.connection_failed',
        1 => 127,
      ),
      13 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.connection_success',
        1 => 134,
      ),
      14 => 
      array (
        0 => 'saas.pages.tenant_settings.actions.sync_shop_url',
        1 => 138,
      ),
      15 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.no_tenant',
        1 => 143,
      ),
      16 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.sync_failed',
        1 => 153,
      ),
      17 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.sync_success',
        1 => 162,
      ),
      18 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.no_tenant',
        1 => 173,
      ),
      19 => 
      array (
        0 => 'saas.pages.tenant_settings.notifications.saved',
        1 => 216,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Filament\\Saas\\Pages\\TenantSettings',
        1 => 'tenantDataForForm',
        2 => 'App\\Filament\\Saas\\Pages\\TenantSettings',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Filament\\Forms\\Concerns\\InteractsWithForms',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts',
        1 => 'getHeaderActions',
        2 => 'App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.resources.products.view.actions.update_stock',
        1 => 21,
      ),
      1 => 
      array (
        0 => 'saas.resources.products.view.fields.stock_qty',
        1 => 24,
      ),
      2 => 
      array (
        0 => 'saas.resources.products.view.notifications.stock_update_success',
        1 => 41,
      ),
      3 => 
      array (
        0 => 'saas.resources.products.view.notifications.stock_update_failed',
        1 => 46,
      ),
      4 => 
      array (
        0 => 'saas.resources.products.view.actions.update_base_price',
        1 => 52,
      ),
      5 => 
      array (
        0 => 'saas.resources.products.view.fields.base_price_tax_excl',
        1 => 55,
      ),
      6 => 
      array (
        0 => 'saas.resources.products.view.notifications.base_price_update_success',
        1 => 72,
      ),
      7 => 
      array (
        0 => 'saas.resources.products.view.notifications.base_price_update_failed',
        1 => 77,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.resources.products.navigation_label',
        1 => 34,
      ),
      1 => 
      array (
        0 => 'saas.resources.products.model_label',
        1 => 39,
      ),
      2 => 
      array (
        0 => 'saas.resources.products.plural_model_label',
        1 => 44,
      ),
      3 => 
      array (
        0 => 'saas.resources.products.table.search_placeholder',
        1 => 75,
      ),
      4 => 
      array (
        0 => 'saas.resources.products.table.columns.id',
        1 => 78,
      ),
      5 => 
      array (
        0 => 'saas.resources.products.table.columns.name',
        1 => 81,
      ),
      6 => 
      array (
        0 => 'saas.resources.products.table.columns.reference',
        1 => 85,
      ),
      7 => 
      array (
        0 => 'saas.resources.products.table.columns.manufacturer',
        1 => 88,
      ),
      8 => 
      array (
        0 => 'saas.resources.products.table.columns.active',
        1 => 91,
      ),
      9 => 
      array (
        0 => 'saas.resources.products.table.columns.stock_qty',
        1 => 94,
      ),
      10 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_excl',
        1 => 99,
      ),
      11 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_excl',
        1 => 104,
      ),
      12 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_incl',
        1 => 109,
      ),
      13 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_incl',
        1 => 115,
      ),
      14 => 
      array (
        0 => 'saas.resources.products.table.actions.view',
        1 => 123,
      ),
      15 => 
      array (
        0 => 'saas.resources.products.table.empty_state_heading',
        1 => 126,
      ),
      16 => 
      array (
        0 => 'saas.resources.products.infolist.sections.general',
        1 => 133,
      ),
      17 => 
      array (
        0 => 'saas.resources.products.table.columns.id',
        1 => 137,
      ),
      18 => 
      array (
        0 => 'saas.resources.products.table.columns.name',
        1 => 139,
      ),
      19 => 
      array (
        0 => 'saas.resources.products.table.columns.reference',
        1 => 141,
      ),
      20 => 
      array (
        0 => 'saas.resources.products.table.columns.manufacturer',
        1 => 143,
      ),
      21 => 
      array (
        0 => 'saas.resources.products.table.columns.active',
        1 => 145,
      ),
      22 => 
      array (
        0 => 'saas.resources.products.states.active',
        1 => 149,
      ),
      23 => 
      array (
        0 => 'saas.resources.products.states.inactive',
        1 => 150,
      ),
      24 => 
      array (
        0 => 'saas.resources.products.table.columns.stock_qty',
        1 => 154,
      ),
      25 => 
      array (
        0 => 'saas.resources.products.infolist.sections.pricing',
        1 => 157,
      ),
      26 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_excl',
        1 => 161,
      ),
      27 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_excl',
        1 => 164,
      ),
      28 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_incl',
        1 => 167,
      ),
      29 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_incl',
        1 => 170,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
        1 => 'canCreate',
        2 => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
      ),
      1 => 
      array (
        0 => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
        1 => 'canEdit',
        2 => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
      ),
      2 => 
      array (
        0 => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
        1 => 'canDelete',
        2 => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.api.products.not_found',
        1 => 60,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 'App\\Http\\Controllers\\Api\\V1\\ProductController',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\Api\\V1\\ProductController',
        1 => 'isActive',
        2 => 'App\\Http\\Controllers\\Api\\V1\\ProductController',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Requests/Api/V1/ListProductsRequest.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.api.products.validation.q.string',
        1 => 37,
      ),
      1 => 
      array (
        0 => 'saas.api.products.validation.q.max',
        1 => 38,
      ),
      2 => 
      array (
        0 => 'saas.api.products.validation.category.string',
        1 => 39,
      ),
      3 => 
      array (
        0 => 'saas.api.products.validation.category.max',
        1 => 40,
      ),
      4 => 
      array (
        0 => 'saas.api.products.validation.manufacturer.string',
        1 => 41,
      ),
      5 => 
      array (
        0 => 'saas.api.products.validation.manufacturer.max',
        1 => 42,
      ),
      6 => 
      array (
        0 => 'saas.api.products.validation.min_price.numeric',
        1 => 43,
      ),
      7 => 
      array (
        0 => 'saas.api.products.validation.min_price.min',
        1 => 44,
      ),
      8 => 
      array (
        0 => 'saas.api.products.validation.max_price.numeric',
        1 => 45,
      ),
      9 => 
      array (
        0 => 'saas.api.products.validation.max_price.gte',
        1 => 46,
      ),
      10 => 
      array (
        0 => 'saas.api.products.validation.has_discount.boolean',
        1 => 47,
      ),
      11 => 
      array (
        0 => 'saas.api.products.validation.page.integer',
        1 => 48,
      ),
      12 => 
      array (
        0 => 'saas.api.products.validation.page.min',
        1 => 49,
      ),
      13 => 
      array (
        0 => 'saas.api.products.validation.per_page.integer',
        1 => 50,
      ),
      14 => 
      array (
        0 => 'saas.api.products.validation.per_page.min',
        1 => 51,
      ),
      15 => 
      array (
        0 => 'saas.api.products.validation.per_page.max',
        1 => 52,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\Api\\V1\\ListProductsRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\Api\\V1\\ListProductsRequest',
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\Api\\V1\\ListProductsRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\Api\\V1\\ListProductsRequest',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ReindexTenantProductsJob.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.typesense.reindex.started',
        1 => 19,
      ),
      1 => 
      array (
        0 => 'saas.typesense.reindex.completed',
        1 => 26,
      ),
      2 => 
      array (
        0 => 'saas.typesense.reindex.failed',
        1 => 30,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 'App\\Jobs\\ReindexTenantProductsJob',
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Foundation\\Queue\\Queueable',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ApiToken',
        1 => 'casts',
        2 => 'App\\Models\\ApiToken',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\AuditLog',
        1 => 'casts',
        2 => 'App\\Models\\AuditLog',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Job',
        1 => 'casts',
        2 => 'App\\Models\\Job',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Revision',
        1 => 'casts',
        2 => 'App\\Models\\Revision',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Tenant',
        1 => 'casts',
        2 => 'App\\Models\\Tenant',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantUser.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\TenantUser',
        1 => 'casts',
        2 => 'App\\Models\\TenantUser',
      ),
      1 => 
      array (
        0 => 'App\\Models\\TenantUser',
        1 => 'isAdmin',
        2 => 'App\\Models\\TenantUser',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'casts',
        2 => 'App\\Models\\User',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\Gate',
        1 => 'define',
        2 => 28,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\Gate',
        1 => 'define',
        2 => 32,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\RateLimiter',
        1 => 'for',
        2 => 36,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/PricingService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 'App\\Services\\PricingService',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 'App\\Services\\ProductWriteService',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantContext.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TenantContext',
        1 => 'getTenant',
        2 => 'App\\Services\\TenantContext',
      ),
      1 => 
      array (
        0 => 'App\\Services\\TenantContext',
        1 => 'tenantId',
        2 => 'App\\Services\\TenantContext',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 'App\\Services\\TenantPrestaShopConnection',
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\DatabaseManager',
        1 => 'reconnect',
        2 => 41,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TypeSenseClient.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TypeSenseClient',
        1 => 'collectionName',
        2 => 'App\\Services\\TypeSenseClient',
      ),
    ),
  ),
); },
	'dependencies' => array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/Dashboard.php' => 
  array (
    'fileHash' => '86ec53de2ec76633505a14fb3c14bb1165fb45e48214f6914b1c538be2ece471',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php' => 
  array (
    'fileHash' => '38a1b5b958c798f979085cc8f0caba00c30603ac28970c6f3b426ec6b82ad4f0',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php' => 
  array (
    'fileHash' => 'dc7ae129113fd481558fe92bcb5d1de82ae83ae3d1c9645a36cb2e55a1f3bd1d',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php' => 
  array (
    'fileHash' => 'f89aab2f3634dfee6c6adca84c4f70fde71840ebeee871c1528388c972cb17f1',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php' => 
  array (
    'fileHash' => '82f1c5002e8ec44cc6267553910f70053375552f2c318ce10146e0b4e618d32f',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php' => 
  array (
    'fileHash' => '8e6dff3feaf1acd4154b958e0f6100fde4928aebbd50bfe1d3177967245a11b6',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Controller.php' => 
  array (
    'fileHash' => '25d1c1ef8e6cc8a376553faacfba2b07d9dfaee9bdbb84f14f77517580e9deb1',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php' => 
  array (
    'fileHash' => 'a14a10753812d8ef29313430602524e7f21c745028007c9e53a2f12db75feafb',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Requests/Api/V1/ListProductsRequest.php' => 
  array (
    'fileHash' => '8e73f751f1b4bc44de22374ab2af657591a012dc95eddc3669a9038c3cc52110',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ReindexTenantProductsJob.php' => 
  array (
    'fileHash' => 'fb5c7fb1ea6e0cae8052d1127ec08f293bc4d01fdcfe78d395ea273fe21aeb1d',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php' => 
  array (
    'fileHash' => '4039b671960d080bc1fca27d8c46e2bde40f4ef85d54c8f3bb539b83c1a58e1f',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php' => 
  array (
    'fileHash' => 'e1518f191625252127231446f220058a0547d61d5d3a709f8c9b1b5a0383096e',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php' => 
  array (
    'fileHash' => '7a212e7926902680fb4a9522cbb6ca5226dbc9a66c82e5aabc8bd65f5eea13f1',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php' => 
  array (
    'fileHash' => '74bdfd7aaa860569c99070db4e2cb367cb9f2b5b0e955b115fbbe5bd3839d14c',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/RevisionService.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php' => 
  array (
    'fileHash' => '90e4c3cb7541eb541c5763c76398b4aea43202f25ee5bbbf2cd10b9852e6a4f5',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php',
      3 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php',
      4 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php',
      5 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php',
      6 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantUser.php',
      7 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php',
      8 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php',
      9 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantContext.php',
      10 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopProduct.php' => 
  array (
    'fileHash' => '4155256f60216bbdadc471bb7d0c01fe9cfa0e76ea9359f60aa1bf6ee95e984c',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantUser.php' => 
  array (
    'fileHash' => '2395a18207300b2e16def0a45955c0e0f704d0fd76a5ede1881ef4f13486ccf9',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php',
      3 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php' => 
  array (
    'fileHash' => 'c5b771c24e3b766b12db46c2c85fcdb2e324c55858c4a5ab05ae80f124e2a9b1',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php',
      3 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php',
      4 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php' => 
  array (
    'fileHash' => '0ade9c9cdfe7c016cf99ca5a1fc13b55806715d4a78143414247b0ad31728194',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/PricingService.php' => 
  array (
    'fileHash' => 'db7f177750af257453b65626a539e36e489c5b2cd5ca1728c3f55adda63db2c0',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php' => 
  array (
    'fileHash' => '94bc3129970283da1baf2c1c3737043f118dd92286ec1d9dd05544d350fdc72a',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/RevisionService.php' => 
  array (
    'fileHash' => 'a2d3a40f18f3ca384392300917a54f31dbe6b4786ba1df4b5a6737d1397d55c8',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantContext.php' => 
  array (
    'fileHash' => 'f01e97822a71d7535aa59aea63560c85157ca391c17b7e6a60b6f82f6f6f7297',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php',
      3 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php',
      4 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php',
      5 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
      6 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php' => 
  array (
    'fileHash' => 'b6dc1ae52d0dac44439710e6c74c192af738c85a90f39b9ab9cc2bbb3a2a54f7',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php',
      3 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopProduct.php',
      4 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/PricingService.php',
      5 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TypeSenseClient.php' => 
  array (
    'fileHash' => '2cd8c6686ce9bae5a1820e8dea4598a98e5893fa2f03a8a1b6780d139956c55d',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ReindexTenantProductsJob.php',
      3 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php',
    ),
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/Dashboard.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Saas\\Pages\\Dashboard',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Pages\\Dashboard',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'navigationIcon',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getNavigationLabel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTitle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Pages/TenantSettings.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Saas\\Pages\\TenantSettings',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Pages\\Page',
       'implements' => 
      array (
        0 => 'Filament\\Forms\\Contracts\\HasForms',
      ),
       'usedTraits' => 
      array (
        0 => 'Filament\\Forms\\Concerns\\InteractsWithForms',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'navigationIcon',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'slug',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'view',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'data',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var array<string, mixed>
     */',
             'namespace' => 'App\\Filament\\Saas\\Pages',
             'uses' => 
            array (
              'tenant' => 'App\\Models\\Tenant',
              'tenantuser' => 'App\\Models\\TenantUser',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'tenantprestashopconnection' => 'App\\Services\\TenantPrestaShopConnection',
              'action' => 'Filament\\Actions\\Action',
              'textinput' => 'Filament\\Forms\\Components\\TextInput',
              'interactswithforms' => 'Filament\\Forms\\Concerns\\InteractsWithForms',
              'hasforms' => 'Filament\\Forms\\Contracts\\HasForms',
              'form' => 'Filament\\Forms\\Form',
              'notification' => 'Filament\\Notifications\\Notification',
              'page' => 'Filament\\Pages\\Page',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => '?array',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'shouldRegisterNavigation',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canAccess',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getNavigationLabel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTitle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'form',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Filament\\Forms\\Form',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'form',
               'type' => 'Filament\\Forms\\Form',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getHeaderActions',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<Action>
     */',
             'namespace' => 'App\\Filament\\Saas\\Pages',
             'uses' => 
            array (
              'tenant' => 'App\\Models\\Tenant',
              'tenantuser' => 'App\\Models\\TenantUser',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'tenantprestashopconnection' => 'App\\Services\\TenantPrestaShopConnection',
              'action' => 'Filament\\Actions\\Action',
              'textinput' => 'Filament\\Forms\\Components\\TextInput',
              'interactswithforms' => 'Filament\\Forms\\Concerns\\InteractsWithForms',
              'hasforms' => 'Filament\\Forms\\Contracts\\HasForms',
              'form' => 'Filament\\Forms\\Form',
              'notification' => 'Filament\\Notifications\\Notification',
              'page' => 'Filament\\Pages\\Page',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ListProducts.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Pages\\ListRecords',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'resource',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getHeaderActions',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/Pages/ViewProduct.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Pages\\ViewRecord',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'resource',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getHeaderActions',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Saas/Resources/Products/ProductResource.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Saas\\Resources\\Products\\ProductResource',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Resource',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'model',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'navigationIcon',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'navigationSort',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getNavigationLabel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getModelLabel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getPluralModelLabel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canViewAny',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canView',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'record',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canCreate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canEdit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'record',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canDelete',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'record',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'table',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Tables\\Table',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'table',
               'type' => 'Filament\\Tables\\Table',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'infolist',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Infolists\\Infolist',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'infolist',
               'type' => 'Filament\\Infolists\\Infolist',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getPages',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, class-string>
     */',
             'namespace' => 'App\\Filament\\Saas\\Resources\\Products',
             'uses' => 
            array (
              'listproducts' => 'App\\Filament\\Saas\\Resources\\Products\\Pages\\ListProducts',
              'viewproduct' => 'App\\Filament\\Saas\\Resources\\Products\\Pages\\ViewProduct',
              'tenantprestashopproduct' => 'App\\Models\\TenantPrestaShopProduct',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'tenantprestashopconnection' => 'App\\Services\\TenantPrestaShopConnection',
              'typesenseclient' => 'App\\Services\\TypeSenseClient',
              'section' => 'Filament\\Infolists\\Components\\Section',
              'textentry' => 'Filament\\Infolists\\Components\\TextEntry',
              'infolist' => 'Filament\\Infolists\\Infolist',
              'resource' => 'Filament\\Resources\\Resource',
              'viewaction' => 'Filament\\Tables\\Actions\\ViewAction',
              'iconcolumn' => 'Filament\\Tables\\Columns\\IconColumn',
              'textcolumn' => 'Filament\\Tables\\Columns\\TextColumn',
              'table' => 'Filament\\Tables\\Table',
              'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'gate' => 'Illuminate\\Support\\Facades\\Gate',
              'throwable' => 'Throwable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getEloquentQuery',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Api\\V1\\ProductController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'typeSenseClient',
               'type' => 'App\\Services\\TypeSenseClient',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantContext',
               'type' => 'App\\Services\\TenantContext',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\Api\\V1\\ListProductsRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Controller.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Controller',
       'phpDoc' => NULL,
       'abstract' => true,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\ResolveSaasTenant',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Requests/Api/V1/ListProductsRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\Api\\V1\\ListProductsRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Http\\Requests\\Api\\V1',
             'uses' => 
            array (
              'formrequest' => 'Illuminate\\Foundation\\Http\\FormRequest',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'messages',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Http\\Requests\\Api\\V1',
             'uses' => 
            array (
              'formrequest' => 'Illuminate\\Foundation\\Http\\FormRequest',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ReindexTenantProductsJob.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Jobs\\ReindexTenantProductsJob',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Queue\\ShouldQueue',
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Foundation\\Queue\\Queueable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'typeSenseClient',
               'type' => 'App\\Services\\TypeSenseClient',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ApiToken',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenant',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Tenant, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'setTokenHashAttribute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'value',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'issue',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array<int, string>  $abilities
     * @return array{0: self, 1: string}
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'abilities',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\AuditLog',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'timestamps',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenant',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Tenant, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'actor',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Job',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenant',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Tenant, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'creator',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Revision',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'timestamps',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenant',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Tenant, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'actor',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Tenant',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'dbPasswordEncrypted',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'users',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'apiTokens',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<ApiToken, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'jobs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<Job, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'auditLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<AuditLog, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'attribute' => 'Illuminate\\Database\\Eloquent\\Casts\\Attribute',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopProduct.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TenantPrestaShopProduct',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'connection',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'primaryKey',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'incrementing',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'keyType',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'timestamps',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTable',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantUser.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TenantUser',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Foundation\\Auth\\User',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenant',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Tenant, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'canAccessPanel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'panel',
               'type' => 'mixed',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isAdmin',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\User',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Foundation\\Auth\\User',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenant',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Tenant, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'createdJobs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<Job, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'auditLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<AuditLog, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Providers\\AppServiceProvider',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Support\\ServiceProvider',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'register',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Register any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'tenantuser' => 'App\\Models\\TenantUser',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'limit' => 'Illuminate\\Cache\\RateLimiting\\Limit',
              'request' => 'Illuminate\\Http\\Request',
              'gate' => 'Illuminate\\Support\\Facades\\Gate',
              'ratelimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'boot',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Bootstrap any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'tenantuser' => 'App\\Models\\TenantUser',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'limit' => 'Illuminate\\Cache\\RateLimiting\\Limit',
              'request' => 'Illuminate\\Http\\Request',
              'gate' => 'Illuminate\\Support\\Facades\\Gate',
              'ratelimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/PricingService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\PricingService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantPrestaShopConnection',
               'type' => 'App\\Services\\TenantPrestaShopConnection',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'computeForProduct',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array{
     *     original_price_tax_excl:float,
     *     current_price_tax_excl:float,
     *     original_price_tax_incl:float,
     *     current_price_tax_incl:float,
     *     discount_amount_tax_excl:float,
     *     discount_percent:float
     * }
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'carbon' => 'Illuminate\\Support\\Carbon',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'runtimeexception' => 'RuntimeException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'computeTaxIncl',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'priceExcl',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vatRate',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resolveVatRateForProduct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resolveCurrentPriceFromSpecificPrices',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  iterable<object{price:float|int|string,reduction:float|int|string,reduction_type:string}|array{price:float|int|string,reduction:float|int|string,reduction_type:string}>  $specificPrices
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'carbon' => 'Illuminate\\Support\\Carbon',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'runtimeexception' => 'RuntimeException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'originalPrice',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'specificPrices',
               'type' => 'iterable',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\ProductWriteService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantContext',
               'type' => 'App\\Services\\TenantContext',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantPrestaShopConnection',
               'type' => 'App\\Services\\TenantPrestaShopConnection',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'pricingService',
               'type' => 'App\\Services\\PricingService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'typeSenseClient',
               'type' => 'App\\Services\\TypeSenseClient',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateProductStock',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'qty',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateProductBasePrice',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'priceExcl',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/RevisionService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\RevisionService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'recordRevision',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array<string, mixed>|null  $before
     * @param  array<string, mixed>|null  $after
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'revision' => 'App\\Models\\Revision',
              'runtimeexception' => 'RuntimeException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\Revision',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actorUserId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'entityType',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'entityId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'action',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            5 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'before',
               'type' => '?array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            6 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'after',
               'type' => '?array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            7 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'source',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            8 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getRevision',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?App\\Models\\Revision',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantContext.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TenantContext',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'setTenant',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenant',
               'type' => 'App\\Models\\Tenant',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTenant',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?App\\Models\\Tenant',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tenantId',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'clear',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TenantPrestaShopConnection',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantContext',
               'type' => 'App\\Services\\TenantContext',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'connect',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenant',
               'type' => '?App\\Models\\Tenant',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'table',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenant',
               'type' => '?App\\Models\\Tenant',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'testConnection',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenant',
               'type' => '?App\\Models\\Tenant',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'onboard',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenant',
               'type' => '?App\\Models\\Tenant',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TypeSenseClient.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TypeSenseClient',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ensureCollectionExists',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'upsertProductDoc',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array<string, mixed>  $document
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'pendingrequest' => 'Illuminate\\Http\\Client\\PendingRequest',
              'response' => 'Illuminate\\Http\\Client\\Response',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'runtimeexception' => 'RuntimeException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'document',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'deleteProductDoc',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int|string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'searchProductDocs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array<string, mixed>  $filters
     * @return array{data: array<int, array<string, mixed>>, total: int}
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'pendingrequest' => 'Illuminate\\Http\\Client\\PendingRequest',
              'response' => 'Illuminate\\Http\\Client\\Response',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'runtimeexception' => 'RuntimeException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'page',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'perPage',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'filters',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getProductDoc',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>|null
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'pendingrequest' => 'Illuminate\\Http\\Client\\PendingRequest',
              'response' => 'Illuminate\\Http\\Client\\Response',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'runtimeexception' => 'RuntimeException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'tenantId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int|string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
