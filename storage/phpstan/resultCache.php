<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1771487832,
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
    0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources',
    1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products',
  ),
  'scannedFiles' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Pages/BulkPriceUpdate.php' => 'e356a580cdaeeb1fb294676f29eab930fba8fca2a758b7660f4794117fbc490a',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Pages/Dashboard.php' => 'd310dbe09ebf449c289398e9f322fc9ef8a7a91aa07cc49ad591a6f9757ddf2d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Pages/TenantSettings.php' => '33582884967dbc94442c3f78da5a9f404451c44467ae302914df94785cb89617',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Admin/ImpersonateUserController.php' => '70b2e19d13339b664f41dcecdc0a2aa4a1af3507161a36e31cd7fdf61b3d0404',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php' => '8e6dff3feaf1acd4154b958e0f6100fde4928aebbd50bfe1d3177967245a11b6',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Controller.php' => '25d1c1ef8e6cc8a376553faacfba2b07d9dfaee9bdbb84f14f77517580e9deb1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php' => 'a14a10753812d8ef29313430602524e7f21c745028007c9e53a2f12db75feafb',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Requests/Api/V1/ListProductsRequest.php' => '8e73f751f1b4bc44de22374ab2af657591a012dc95eddc3669a9038c3cc52110',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/FinalizeBulkPriceUpdateJob.php' => 'f8bf06d0e32957d18278c19406b34da7f4d097e6b0e42de7e704b2283b8f73de',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ProcessBulkPriceUpdateChunkJob.php' => '7af13c56472eb16556e9fcb20b9fa220d4efe24224133114fc5166b39fffac98',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ReindexTenantProductsJob.php' => 'fb5c7fb1ea6e0cae8052d1127ec08f293bc4d01fdcfe78d395ea273fe21aeb1d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/StartBulkPriceUpdateJob.php' => '63724d20aa60a39c53064ec55c38f9bb50150630283c0b6d6b1ef35f67bd5a43',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php' => '4039b671960d080bc1fca27d8c46e2bde40f4ef85d54c8f3bb539b83c1a58e1f',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php' => 'e1518f191625252127231446f220058a0547d61d5d3a709f8c9b1b5a0383096e',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php' => '7a212e7926902680fb4a9522cbb6ca5226dbc9a66c82e5aabc8bd65f5eea13f1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php' => '74bdfd7aaa860569c99070db4e2cb367cb9f2b5b0e955b115fbbe5bd3839d14c',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php' => '90e4c3cb7541eb541c5763c76398b4aea43202f25ee5bbbf2cd10b9852e6a4f5',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopProduct.php' => '35154048533c308b5ee1e511a5b86870aae19f3c777789ec01c386e60a7574e4',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopSpecificPrice.php' => '5af80f67d96a712646023ca174c723f5a2d58d7bc8ae88276c54975a786207c4',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantUser.php' => '2395a18207300b2e16def0a45955c0e0f704d0fd76a5ede1881ef4f13486ccf9',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php' => '431f4797e3967dc2ac07de27a0aecb825bf5d1a919f37cc9c99a4092acd958d0',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php' => '0e2e293157e0e529f20df8c908d8c64c59ca841b5ff86df1b1dedca07d881b2a',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/Filament/AdminPanelProvider.php' => 'c6b13e7d474d30fe54ae6f00a0618ba2c46c78d675a62fdf4600028d553feb0f',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/Filament/AppPanelProvider.php' => 'e37964805ba1c9ca3bdc122fd99deabfdb4e7374576439e49e943f4418d8d4f1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/BulkPriceUpdateService.php' => 'f00c55ecdbed313452571889381d507ba31f151f66d1384274fe8851e940879a',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/PricingService.php' => 'db7f177750af257453b65626a539e36e489c5b2cd5ca1728c3f55adda63db2c0',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php' => '88e241891e9b455dc085b0758cbd406476aa66281527ea22dfc0b28ea47dd17d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/RevisionService.php' => 'a2d3a40f18f3ca384392300917a54f31dbe6b4786ba1df4b5a6737d1397d55c8',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantContext.php' => 'f01e97822a71d7535aa59aea63560c85157ca391c17b7e6a60b6f82f6f6f7297',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php' => 'b6dc1ae52d0dac44439710e6c74c192af738c85a90f39b9ab9cc2bbb3a2a54f7',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TypeSenseClient.php' => '2cd8c6686ce9bae5a1820e8dea4598a98e5893fa2f03a8a1b6780d139956c55d',
  ),
  'composerLocks' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/composer.lock' => '114a2477f927b78051c8f3ca1124135484580fd5ec38d945fd07568db631ebf2',
  ),
  'composerInstalled' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'anourvalar/eloquent-serialize' => 
        array (
          'pretty_version' => '1.3.5',
          'version' => '1.3.5.0',
          'reference' => '1a7dead8d532657e5358f8f27c0349373517681e',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../anourvalar/eloquent-serialize',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'blade-ui-kit/blade-heroicons' => 
        array (
          'pretty_version' => '2.6.0',
          'version' => '2.6.0.0',
          'reference' => '4553b2a1f6c76f0ac7f3bc0de4c0cfa06a097d19',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../blade-ui-kit/blade-heroicons',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'blade-ui-kit/blade-icons' => 
        array (
          'pretty_version' => '1.8.1',
          'version' => '1.8.1.0',
          'reference' => '47e7b6f43250e6404e4224db8229219cd42b543c',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../blade-ui-kit/blade-icons',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
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
        'chillerlan/php-qrcode' => 
        array (
          'pretty_version' => '5.0.5',
          'version' => '5.0.5.0',
          'reference' => '7b66282572fc14075c0507d74d9837dab25b38d6',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../chillerlan/php-qrcode',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'chillerlan/php-settings-container' => 
        array (
          'pretty_version' => '3.2.1',
          'version' => '3.2.1.0',
          'reference' => '95ed3e9676a1d47cab2e3174d19b43f5dbf52681',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../chillerlan/php-settings-container',
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
        'danharrin/date-format-converter' => 
        array (
          'pretty_version' => 'v0.3.1',
          'version' => '0.3.1.0',
          'reference' => '7c31171bc981e48726729a5f3a05a2d2b63f0b1e',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../danharrin/date-format-converter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'danharrin/livewire-rate-limiting' => 
        array (
          'pretty_version' => 'v2.1.0',
          'version' => '2.1.0.0',
          'reference' => '14dde653a9ae8f38af07a0ba4921dc046235e1a0',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../danharrin/livewire-rate-limiting',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
        'filament/actions' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => 'ba5d5b91ae4f46dc13e14335fa3fc775b4da996d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/actions',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/filament' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => '1c0d01a9d0dd1b8b1ca08016ed6464ca325c7812',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/filament',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/forms' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => '0c51b91fff831c9a33d01b257803305e7aca9904',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/forms',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/infolists' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => '1829de0cde22d1386e9a565f51a363cadd24f440',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/infolists',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/notifications' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => '3fa5a274fb45f9e9f68ccce06c3fb110adf3e3c3',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/notifications',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/query-builder' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => 'ee6bcb57ce78e8ca5741fdc998c445c7c77e4751',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/query-builder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/schemas' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => 'f09a32b5b3f1ae7479efc3aaf7d3daaa71a665bc',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/schemas',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/support' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => '3566a9a97cab591c829635b6806afc1442491881',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/support',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/tables' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => 'e14c1dd83afce6ae80d7f3e4b3ccf9583a50b0d2',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/tables',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/widgets' => 
        array (
          'pretty_version' => 'v5.2.1',
          'version' => '5.2.1.0',
          'reference' => '7f47eb48be64110fd1dcea3155834648cb17df30',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/widgets',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
        'kirschbaum-development/eloquent-power-joins' => 
        array (
          'pretty_version' => '4.2.11',
          'version' => '4.2.11.0',
          'reference' => '0e3e3372992e4bf82391b3c7b84b435c3db73588',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../kirschbaum-development/eloquent-power-joins',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
        'league/csv' => 
        array (
          'pretty_version' => '9.28.0',
          'version' => '9.28.0.0',
          'reference' => '6582ace29ae09ba5b07049d40ea13eb19c8b5073',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/csv',
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
        'league/uri-components' => 
        array (
          'pretty_version' => '7.8.0',
          'version' => '7.8.0.0',
          'reference' => '8b5ffcebcc0842b76eb80964795bd56a8333b2ba',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/uri-components',
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
        'livewire/livewire' => 
        array (
          'pretty_version' => 'v4.1.4',
          'version' => '4.1.4.0',
          'reference' => '4697085e02a1f5f11410a1b5962400e3539f8843',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../livewire/livewire',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'masterminds/html5' => 
        array (
          'pretty_version' => '2.10.0',
          'version' => '2.10.0.0',
          'reference' => 'fcf91eb64359852f00d921887b219479b4f21251',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../masterminds/html5',
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
        'nette/php-generator' => 
        array (
          'pretty_version' => 'v4.2.1',
          'version' => '4.2.1.0',
          'reference' => '52aff4d9b12f20ca9f3e31a559b646d2fd21dd61',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nette/php-generator',
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
        'openspout/openspout' => 
        array (
          'pretty_version' => 'v4.32.0',
          'version' => '4.32.0.0',
          'reference' => '41f045c1f632e1474e15d4c7bc3abcb4a153563d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../openspout/openspout',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'paragonie/constant_time_encoding' => 
        array (
          'pretty_version' => 'v3.1.3',
          'version' => '3.1.3.0',
          'reference' => 'd5b01a39b3415c2cd581d3bd3a3575c1ebbd8e77',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../paragonie/constant_time_encoding',
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
        'pragmarx/google2fa' => 
        array (
          'pretty_version' => 'v9.0.0',
          'version' => '9.0.0.0',
          'reference' => 'e6bc62dd6ae83acc475f57912e27466019a1f2cf',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pragmarx/google2fa',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'pragmarx/google2fa-qrcode' => 
        array (
          'pretty_version' => 'v3.0.0',
          'version' => '3.0.0.0',
          'reference' => 'ce4d8a729b6c93741c607cfb2217acfffb5bf76b',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../pragmarx/google2fa-qrcode',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
        'ryangjchandler/blade-capture-directive' => 
        array (
          'pretty_version' => 'v1.1.0',
          'version' => '1.1.0.0',
          'reference' => 'bbb1513dfd89eaec87a47fe0c449a7e3d4a1976d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../ryangjchandler/blade-capture-directive',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'scrivo/highlight.php' => 
        array (
          'pretty_version' => 'v9.18.1.10',
          'version' => '9.18.1.10',
          'reference' => '850f4b44697a2552e892ffe71490ba2733c2fc6e',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../scrivo/highlight.php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
        'spatie/invade' => 
        array (
          'pretty_version' => '2.1.0',
          'version' => '2.1.0.0',
          'reference' => 'b920f6411d21df4e8610a138e2e87ae4957d7f63',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../spatie/invade',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'spatie/laravel-package-tools' => 
        array (
          'pretty_version' => '1.92.7',
          'version' => '1.92.7.0',
          'reference' => 'f09a799850b1ed765103a4f0b4355006360c49a5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../spatie/laravel-package-tools',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'spatie/once' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'spatie/shiki-php' => 
        array (
          'pretty_version' => '2.3.3',
          'version' => '2.3.3.0',
          'reference' => '9d50ff4d9825d87d3283a6695c65ae9c3c3caa6b',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../spatie/shiki-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
        'symfony/html-sanitizer' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '5b0bbcc3600030b535dd0b17a0e8c56243f96d7f',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/html-sanitizer',
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
        'ueberdosis/tiptap-php' => 
        array (
          'pretty_version' => '2.1.0',
          'version' => '2.1.0.0',
          'reference' => '6ea321fa665080e1a72ac5f52dfab19f6a292e2d',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../ueberdosis/tiptap-php',
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
); },
	'locallyIgnoredErrorsCallback' => static function (): array { return array (
); },
	'linesToIgnore' => array (
),
	'unmatchedLineIgnores' => array (
),
	'collectedDataCallback' => static function (): array { return array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ListProducts.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.pages.bulk_price_update.navigation_label',
        1 => 18,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ViewProduct.php' => 
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
        1 => 43,
      ),
      3 => 
      array (
        0 => 'saas.resources.products.view.notifications.stock_update_failed',
        1 => 48,
      ),
      4 => 
      array (
        0 => 'saas.resources.products.view.actions.update_base_price',
        1 => 54,
      ),
      5 => 
      array (
        0 => 'saas.resources.products.view.fields.base_price_tax_excl',
        1 => 57,
      ),
      6 => 
      array (
        0 => 'saas.resources.products.view.notifications.base_price_update_success',
        1 => 76,
      ),
      7 => 
      array (
        0 => 'saas.resources.products.view.notifications.base_price_update_failed',
        1 => 81,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.resources.products.navigation_label',
        1 => 44,
      ),
      1 => 
      array (
        0 => 'saas.resources.products.model_label',
        1 => 49,
      ),
      2 => 
      array (
        0 => 'saas.resources.products.plural_model_label',
        1 => 54,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
        1 => 'canCreate',
        2 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
      ),
      1 => 
      array (
        0 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
        1 => 'canEdit',
        2 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
      ),
      2 => 
      array (
        0 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
        1 => 'canDelete',
        2 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
      ),
      3 => 
      array (
        0 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
        1 => 'getRelations',
        2 => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/RelationManagers/SpecificPricesRelationManager.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.title',
        1 => 24,
      ),
      1 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.columns.id',
        1 => 38,
      ),
      2 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.columns.price',
        1 => 41,
      ),
      3 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.columns.reduction',
        1 => 45,
      ),
      4 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.columns.reduction_type',
        1 => 49,
      ),
      5 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.columns.from',
        1 => 51,
      ),
      6 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.columns.to',
        1 => 54,
      ),
      7 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.actions.create',
        1 => 59,
      ),
      8 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.notifications.create_success',
        1 => 73,
      ),
      9 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.notifications.create_failed',
        1 => 78,
      ),
      10 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.actions.edit',
        1 => 86,
      ),
      11 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.notifications.update_success',
        1 => 111,
      ),
      12 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.notifications.update_failed',
        1 => 116,
      ),
      13 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.actions.delete',
        1 => 122,
      ),
      14 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.notifications.delete_success',
        1 => 138,
      ),
      15 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.notifications.delete_failed',
        1 => 143,
      ),
      16 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.fields.price',
        1 => 158,
      ),
      17 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.fields.reduction',
        1 => 164,
      ),
      18 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.fields.reduction_type',
        1 => 170,
      ),
      19 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.reduction_types.amount',
        1 => 172,
      ),
      20 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.reduction_types.percentage',
        1 => 173,
      ),
      21 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.fields.from',
        1 => 177,
      ),
      22 => 
      array (
        0 => 'saas.resources.products.relation_managers.specific_prices.fields.to',
        1 => 181,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Schemas/ProductInfolist.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.resources.products.infolist.sections.general',
        1 => 15,
      ),
      1 => 
      array (
        0 => 'saas.resources.products.table.columns.id',
        1 => 19,
      ),
      2 => 
      array (
        0 => 'saas.resources.products.table.columns.name',
        1 => 21,
      ),
      3 => 
      array (
        0 => 'saas.resources.products.table.columns.reference',
        1 => 23,
      ),
      4 => 
      array (
        0 => 'saas.resources.products.table.columns.manufacturer',
        1 => 25,
      ),
      5 => 
      array (
        0 => 'saas.resources.products.table.columns.active',
        1 => 27,
      ),
      6 => 
      array (
        0 => 'saas.resources.products.states.active',
        1 => 31,
      ),
      7 => 
      array (
        0 => 'saas.resources.products.states.inactive',
        1 => 32,
      ),
      8 => 
      array (
        0 => 'saas.resources.products.table.columns.stock_qty',
        1 => 36,
      ),
      9 => 
      array (
        0 => 'saas.resources.products.infolist.sections.pricing',
        1 => 39,
      ),
      10 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_excl',
        1 => 43,
      ),
      11 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_excl',
        1 => 46,
      ),
      12 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_incl',
        1 => 49,
      ),
      13 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_incl',
        1 => 52,
      ),
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Tables/ProductsTable.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'saas.resources.products.table.search_placeholder',
        1 => 16,
      ),
      1 => 
      array (
        0 => 'saas.resources.products.table.columns.id',
        1 => 19,
      ),
      2 => 
      array (
        0 => 'saas.resources.products.table.columns.name',
        1 => 22,
      ),
      3 => 
      array (
        0 => 'saas.resources.products.table.columns.reference',
        1 => 26,
      ),
      4 => 
      array (
        0 => 'saas.resources.products.table.columns.manufacturer',
        1 => 29,
      ),
      5 => 
      array (
        0 => 'saas.resources.products.table.columns.active',
        1 => 32,
      ),
      6 => 
      array (
        0 => 'saas.resources.products.table.columns.stock_qty',
        1 => 35,
      ),
      7 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_excl',
        1 => 40,
      ),
      8 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_excl',
        1 => 45,
      ),
      9 => 
      array (
        0 => 'saas.resources.products.table.columns.original_price_tax_incl',
        1 => 50,
      ),
      10 => 
      array (
        0 => 'saas.resources.products.table.columns.current_price_tax_incl',
        1 => 56,
      ),
      11 => 
      array (
        0 => 'saas.resources.products.table.actions.view',
        1 => 64,
      ),
      12 => 
      array (
        0 => 'saas.resources.products.table.empty_state_heading',
        1 => 67,
      ),
    ),
  ),
); },
	'dependencies' => array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ListProducts.php' => 
  array (
    'fileHash' => '7b718c75facf5945ab3a79b8c8a5959631556f6dc2ffeea9077804cae4484512',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ViewProduct.php' => 
  array (
    'fileHash' => '4a322a42e38cca4bb0ae8ee5b48733a185e3d845e5f3da9fa067612c8f1863ed',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php' => 
  array (
    'fileHash' => '560ec96c98f99b0efa462e6e4b5aa3777497d0e83bc79a51f8002ec563781296',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ListProducts.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ViewProduct.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/RelationManagers/SpecificPricesRelationManager.php' => 
  array (
    'fileHash' => '9ecfc9d1c80054f16ae5a9f1814aaf4d378bf9f54403e4a87ac15571eff56266',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Schemas/ProductInfolist.php' => 
  array (
    'fileHash' => 'd53be30097a3d3d20dcaa72973d82ec3c61a99e95e450fb6a51b7678d4299436',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Tables/ProductsTable.php' => 
  array (
    'fileHash' => '6cb71dcb6dea2fa94aa8b5a3cbd45fbdb0bf5552a6952dcb22a0160acb987aef',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/CreateTenant.php' => 
  array (
    'fileHash' => '63348eeb003ee58759ecc655778cfe3af069968a5d8b50e2a9ebe67ebf1bc08a',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/EditTenant.php' => 
  array (
    'fileHash' => 'b9a4bfcdd7bc9c2d1ecef7ed0dd1a6c807a150a25d9daa9e83678d63d73246b9',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/ListTenants.php' => 
  array (
    'fileHash' => 'fdd137cd4e629f036e7ccec7b23bb0ad8bb8a1c55585dee5149123e518549e3d',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Schemas/TenantForm.php' => 
  array (
    'fileHash' => '1a08f157e2a7faddb78b71a724a5b40d5df56384afab66c50c3541aff90bc99d',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Tables/TenantsTable.php' => 
  array (
    'fileHash' => '9fb72d388578a85d3b7c57092061b044c9f01b3f98e5865fdaf83c9845fcd602',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php' => 
  array (
    'fileHash' => 'c52d63dded369705d9ed8f056bc083a6b812039003a7f7661068368fb214ace0',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/CreateTenant.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/EditTenant.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/ListTenants.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/CreateUser.php' => 
  array (
    'fileHash' => 'c6bb05dfd3550a1f53e5a4f951ef1eb7325c2bf02a14a554c7578529a6093e4e',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/EditUser.php' => 
  array (
    'fileHash' => 'c9786232bb303aca6365d76b62f8170af6bad74d31fb3b4838da5eb155e2d2d8',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/ListUsers.php' => 
  array (
    'fileHash' => 'aa7cad5b07ca26dcbc8bdc4db069e54809a6d73ae294ac03b10b13af0108c1b0',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Schemas/UserForm.php' => 
  array (
    'fileHash' => '662ce78154e899bfafb0eda05bfed7dcc55da7721c98f1a6687681ae8e871613',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Tables/UsersTable.php' => 
  array (
    'fileHash' => 'cdd4f557902318c4141115e30ab49979a5a0a53629ad26ddc84347055c5c2f96',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php' => 
  array (
    'fileHash' => 'c7670c662f6643f3d3539e237f3d303b6a2aad941bd70e1e7b15242212fc582b',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/CreateUser.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/EditUser.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/ListUsers.php',
    ),
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ListProducts.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ListProducts',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ViewProduct.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ViewProduct',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\App\\Resources\\Products\\ProductResource',
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
           'type' => 'string|BackedEnum|null',
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
           'name' => 'infolist',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
        5 => 
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
        6 => 
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
        7 => 
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
        8 => 
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
        9 => 
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
        10 => 
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
        11 => 
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
        12 => 
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
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getRelations',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<int, class-string>
     */',
             'namespace' => 'App\\Filament\\App\\Resources\\Products',
             'uses' => 
            array (
              'listproducts' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ListProducts',
              'viewproduct' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ViewProduct',
              'productinfolist' => 'App\\Filament\\App\\Resources\\Products\\Schemas\\ProductInfolist',
              'productstable' => 'App\\Filament\\App\\Resources\\Products\\Tables\\ProductsTable',
              'specificpricesrelationmanager' => 'App\\Filament\\App\\Resources\\Products\\RelationManagers\\SpecificPricesRelationManager',
              'tenantprestashopproduct' => 'App\\Models\\TenantPrestaShopProduct',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'tenantprestashopconnection' => 'App\\Services\\TenantPrestaShopConnection',
              'typesenseclient' => 'App\\Services\\TypeSenseClient',
              'backedenum' => 'BackedEnum',
              'pageregistration' => 'Filament\\Resources\\Pages\\PageRegistration',
              'resource' => 'Filament\\Resources\\Resource',
              'schema' => 'Filament\\Schemas\\Schema',
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
           'name' => 'getPages',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, PageRegistration>
     */',
             'namespace' => 'App\\Filament\\App\\Resources\\Products',
             'uses' => 
            array (
              'listproducts' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ListProducts',
              'viewproduct' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ViewProduct',
              'productinfolist' => 'App\\Filament\\App\\Resources\\Products\\Schemas\\ProductInfolist',
              'productstable' => 'App\\Filament\\App\\Resources\\Products\\Tables\\ProductsTable',
              'specificpricesrelationmanager' => 'App\\Filament\\App\\Resources\\Products\\RelationManagers\\SpecificPricesRelationManager',
              'tenantprestashopproduct' => 'App\\Models\\TenantPrestaShopProduct',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'tenantprestashopconnection' => 'App\\Services\\TenantPrestaShopConnection',
              'typesenseclient' => 'App\\Services\\TypeSenseClient',
              'backedenum' => 'BackedEnum',
              'pageregistration' => 'Filament\\Resources\\Pages\\PageRegistration',
              'resource' => 'Filament\\Resources\\Resource',
              'schema' => 'Filament\\Schemas\\Schema',
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
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getEloquentQuery',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return Builder<\\Illuminate\\Database\\Eloquent\\Model>
     */',
             'namespace' => 'App\\Filament\\App\\Resources\\Products',
             'uses' => 
            array (
              'listproducts' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ListProducts',
              'viewproduct' => 'App\\Filament\\App\\Resources\\Products\\Pages\\ViewProduct',
              'productinfolist' => 'App\\Filament\\App\\Resources\\Products\\Schemas\\ProductInfolist',
              'productstable' => 'App\\Filament\\App\\Resources\\Products\\Tables\\ProductsTable',
              'specificpricesrelationmanager' => 'App\\Filament\\App\\Resources\\Products\\RelationManagers\\SpecificPricesRelationManager',
              'tenantprestashopproduct' => 'App\\Models\\TenantPrestaShopProduct',
              'tenantcontext' => 'App\\Services\\TenantContext',
              'tenantprestashopconnection' => 'App\\Services\\TenantPrestaShopConnection',
              'typesenseclient' => 'App\\Services\\TypeSenseClient',
              'backedenum' => 'BackedEnum',
              'pageregistration' => 'Filament\\Resources\\Pages\\PageRegistration',
              'resource' => 'Filament\\Resources\\Resource',
              'schema' => 'Filament\\Schemas\\Schema',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/RelationManagers/SpecificPricesRelationManager.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\App\\Resources\\Products\\RelationManagers\\SpecificPricesRelationManager',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\RelationManagers\\RelationManager',
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
            0 => 'relationship',
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
           'name' => 'getTitle',
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
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ownerRecord',
               'type' => 'mixed',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'pageClass',
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
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'form',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
           'name' => 'table',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Schemas/ProductInfolist.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\App\\Resources\\Products\\Schemas\\ProductInfolist',
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
           'name' => 'configure',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Tables/ProductsTable.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\App\\Resources\\Products\\Tables\\ProductsTable',
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
           'name' => 'configure',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/CreateTenant.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Tenants\\Pages\\CreateTenant',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Pages\\CreateRecord',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/EditTenant.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Tenants\\Pages\\EditTenant',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Pages\\EditRecord',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/ListTenants.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Tenants\\Pages\\ListTenants',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Schemas/TenantForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Tenants\\Schemas\\TenantForm',
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
           'name' => 'configure',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Tables/TenantsTable.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Tenants\\Tables\\TenantsTable',
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
           'name' => 'configure',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Tenants\\TenantResource',
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
           'type' => 'string|BackedEnum|null',
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
           'name' => 'form',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getPages',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, PageRegistration>
     */',
             'namespace' => 'App\\Filament\\Resources\\Tenants',
             'uses' => 
            array (
              'createtenant' => 'App\\Filament\\Resources\\Tenants\\Pages\\CreateTenant',
              'edittenant' => 'App\\Filament\\Resources\\Tenants\\Pages\\EditTenant',
              'listtenants' => 'App\\Filament\\Resources\\Tenants\\Pages\\ListTenants',
              'tenantform' => 'App\\Filament\\Resources\\Tenants\\Schemas\\TenantForm',
              'tenantstable' => 'App\\Filament\\Resources\\Tenants\\Tables\\TenantsTable',
              'tenant' => 'App\\Models\\Tenant',
              'backedenum' => 'BackedEnum',
              'pageregistration' => 'Filament\\Resources\\Pages\\PageRegistration',
              'resource' => 'Filament\\Resources\\Resource',
              'schema' => 'Filament\\Schemas\\Schema',
              'table' => 'Filament\\Tables\\Table',
              'gate' => 'Illuminate\\Support\\Facades\\Gate',
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
        8 => 
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
        9 => 
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/CreateUser.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Users\\Pages\\CreateUser',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Pages\\CreateRecord',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/EditUser.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Filament\\Resources\\Pages\\EditRecord',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/ListUsers.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Users\\Pages\\ListUsers',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Schemas/UserForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Users\\Schemas\\UserForm',
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
           'name' => 'configure',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Tables/UsersTable.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Users\\Tables\\UsersTable',
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
           'name' => 'configure',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\Users\\UserResource',
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
           'type' => 'string|BackedEnum|null',
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
           'name' => 'form',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'Filament\\Schemas\\Schema',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'schema',
               'type' => 'Filament\\Schemas\\Schema',
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
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getPages',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, PageRegistration>
     */',
             'namespace' => 'App\\Filament\\Resources\\Users',
             'uses' => 
            array (
              'createuser' => 'App\\Filament\\Resources\\Users\\Pages\\CreateUser',
              'edituser' => 'App\\Filament\\Resources\\Users\\Pages\\EditUser',
              'listusers' => 'App\\Filament\\Resources\\Users\\Pages\\ListUsers',
              'userform' => 'App\\Filament\\Resources\\Users\\Schemas\\UserForm',
              'userstable' => 'App\\Filament\\Resources\\Users\\Tables\\UsersTable',
              'user' => 'App\\Models\\User',
              'backedenum' => 'BackedEnum',
              'pageregistration' => 'Filament\\Resources\\Pages\\PageRegistration',
              'resource' => 'Filament\\Resources\\Resource',
              'schema' => 'Filament\\Schemas\\Schema',
              'table' => 'Filament\\Tables\\Table',
              'gate' => 'Illuminate\\Support\\Facades\\Gate',
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
        8 => 
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
        9 => 
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
