<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1775804934,
	'meta' => array (
  'cacheVersion' => 'v12-linesToIgnore',
  'phpstanVersion' => '2.1.46',
  'fnsr' => false,
  'metaExtensions' => 
  array (
  ),
  'phpVersion' => 80419,
  'projectConfig' => '{conditionalTags: {Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule: {phpstan.rules.rule: %noEnvCallsOutsideOfConfig%}, Larastan\\Larastan\\Rules\\NoModelMakeRule: {phpstan.rules.rule: %noModelMake%}, Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule: {phpstan.rules.rule: %noUnnecessaryCollectionCall%}, Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule: {phpstan.rules.rule: %noUnnecessaryEnumerableToArrayCalls%}, Larastan\\Larastan\\Rules\\OctaneCompatibilityRule: {phpstan.rules.rule: %checkOctaneCompatibility%}, Larastan\\Larastan\\Rules\\UnusedViewsRule: {phpstan.rules.rule: %checkUnusedViews%}, Larastan\\Larastan\\Rules\\NoMissingTranslationsRule: {phpstan.rules.rule: %checkMissingTranslations%}, Larastan\\Larastan\\Rules\\ModelAppendsRule: {phpstan.rules.rule: %checkModelAppends%}, Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule: {phpstan.rules.rule: %checkModelMethodVisibility%}, Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %generalizeEnvReturnType%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension: {phpstan.broker.dynamicMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension: {phpstan.broker.dynamicStaticMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\Rules\\ConfigCollectionRule: {phpstan.rules.rule: %checkConfigTypes%}}, parameters: {universalObjectCratesClasses: [Illuminate\\Http\\Request, Illuminate\\Support\\Optional], earlyTerminatingFunctionCalls: [abort, dd], mixinExcludeClasses: [Eloquent], bootstrapFiles: [bootstrap.php, bootstrap/app.php], checkOctaneCompatibility: false, noEnvCallsOutsideOfConfig: true, noModelMake: true, noUnnecessaryCollectionCall: true, noUnnecessaryCollectionCallOnly: [], noUnnecessaryCollectionCallExcept: [], noUnnecessaryEnumerableToArrayCalls: false, squashedMigrationsPath: [], databaseMigrationsPath: [], disableMigrationScan: false, disableSchemaScan: false, configDirectories: [], viewDirectories: [], translationDirectories: [], checkModelProperties: false, checkUnusedViews: false, checkMissingTranslations: false, checkModelAppends: true, checkModelMethodVisibility: false, generalizeEnvReturnType: false, checkConfigTypes: false, checkAuthCallsWhenInRequestScope: false, parseModelCastsMethod: false, enableMigrationCache: false, level: 6, paths: [/Users/fabionbaromeo/Herd/isb-presta-manager/app], tmpDir: /Users/fabionbaromeo/Herd/isb-presta-manager/storage/phpstan}, rules: [Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessWithFunctionCallsRule, Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessValueFunctionCallsRule, Larastan\\Larastan\\Rules\\DeferrableServiceProviderMissingProvidesRule, Larastan\\Larastan\\Rules\\ConsoleCommand\\UndefinedArgumentOrOptionRule], services: {{class: Larastan\\Larastan\\Methods\\RelationForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\EloquentBuilderForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderTapProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderCollectionProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\StorageMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\Extension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelFactoryMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\RedirectResponseMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\MacroMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ViewWithMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelAccessorExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\HigherOrderCollectionProxyPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\HigherOrderTapProxyExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\Properties\\ModelRelationsExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelOnlyDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelFactoryDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthManagerExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DateExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestFileExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestRouteExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestUserExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentBuilderExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RelationCollectionExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TestCaseExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Support\\CollectionHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AuthExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\CollectExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\NowAndTodayExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ResponseExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValidatorExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\LiteralExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionFilterRejectDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionWhereNotNullDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\NewModelQueryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\FactoryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: true}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: true}}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AppExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValueExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\StrExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\TapExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\StorageDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\GenericEloquentCollectionTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Types\\ViewStringTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Rules\\OctaneCompatibilityRule}, {class: Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule, arguments: {configDirectories: %configDirectories%}}, {class: Larastan\\Larastan\\Rules\\NoModelMakeRule}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule, arguments: {onlyMethods: %noUnnecessaryCollectionCallOnly%, excludeMethods: %noUnnecessaryCollectionCallExcept%}}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule}, {class: Larastan\\Larastan\\Rules\\ModelAppendsRule}, {class: Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule}, {class: Larastan\\Larastan\\Types\\GenericEloquentBuilderTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppFacadeEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\ModelProperty\\ModelPropertyTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension], arguments: {active: %checkModelProperties%}}, {class: Larastan\\Larastan\\Types\\CollectionOf\\CollectionOfTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Properties\\MigrationHelper, arguments: {databaseMigrationPath: %databaseMigrationsPath%, disableMigrationScan: %disableMigrationScan%, parser: @migrationsParser, reflectionProvider: @reflectionProvider}}, iamcalSqlParser: {class: Larastan\\Larastan\\SQL\\IamcalSqlParser, autowired: false}, sqlParserFactory: {class: Larastan\\Larastan\\SQL\\SqlParserFactory, arguments: {iamcalSqlParser: @iamcalSqlParser}}, sqlParser: {type: Larastan\\Larastan\\SQL\\SqlParser, factory: [@sqlParserFactory, create]}, {class: Larastan\\Larastan\\Properties\\SquashedMigrationHelper, arguments: {schemaPaths: %squashedMigrationsPath%, disableSchemaScan: %disableSchemaScan%}}, {class: Larastan\\Larastan\\Properties\\ModelCastHelper, arguments: {parser: @currentPhpVersionSimpleDirectParser, parseModelCastsMethod: %parseModelCastsMethod%}}, {class: Larastan\\Larastan\\Properties\\MigrationCache, arguments: {cacheDirectory: %tmpDir%, enabled: %enableMigrationCache%}}, {class: Larastan\\Larastan\\Properties\\ModelPropertyHelper}, {class: Larastan\\Larastan\\Rules\\ModelRuleHelper}, {class: Larastan\\Larastan\\Methods\\BuilderHelper, arguments: {checkProperties: %checkModelProperties%}}, {class: Larastan\\Larastan\\Rules\\RelationExistenceRule, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Bus\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Events\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Properties\\Schema\\MySqlDataTypeToPhpTypeConverter}, {class: Larastan\\Larastan\\LarastanStubFilesExtension, tags: [phpstan.stubFilesExtension]}, {class: Larastan\\Larastan\\Rules\\UnusedViewsRule}, {class: Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedEmailViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewFacadeMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedRouteFacadeViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewInAnotherViewCollector}, {class: Larastan\\Larastan\\Support\\ViewFileHelper, arguments: {viewDirectories: %viewDirectories%}}, {class: Larastan\\Larastan\\Support\\ViewParser, arguments: {parser: @currentPhpVersionSimpleDirectParser}}, {class: Larastan\\Larastan\\Rules\\NoMissingTranslationsRule, arguments: {translationDirectories: %translationDirectories%}}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationTranslatorCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFacadeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationViewCollector}, {class: Larastan\\Larastan\\ReturnTypes\\ApplicationMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\ArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\OptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasOptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TranslatorGetReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\LangGetReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TransHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DoubleUnderscoreHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeHelper}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationResolver}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationHelper}, {class: Larastan\\Larastan\\Support\\HigherOrderCollectionProxyHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension}, {class: Larastan\\Larastan\\Support\\ConfigParser, arguments: {parser: @currentPhpVersionSimpleDirectParser, configPaths: %configDirectories%, treatPhpDocTypesAsCertain: %treatPhpDocTypesAsCertain%}}, {class: Larastan\\Larastan\\Internal\\ConfigHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\FormRequestSafeDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\ConfigCollectionRule}, {class: Illuminate\\Filesystem\\Filesystem, autowired: self}, migrationsParser: {class: PHPStan\\Parser\\CachedParser, arguments: {originalParser: @currentPhpVersionSimpleDirectParser, cachedNodesByStringCountMax: %cache.nodesByStringCountMax%}, autowired: false}}}',
  'analysedPaths' => 
  array (
    0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens',
    1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/tests/Feature/ApiTokenResourceTest.php',
  ),
  'scannedFiles' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Console/Commands/TypesenseReindexTenantProductsCommand.php' => '02a97ff8683c8355d93c2785f40a15c844d4097231b50c1d211226f2e9a51ec9',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/DTO/ProductViewData.php' => 'daf40fd4cbde3b023c8f12b41b767a128371bebc16459956cf753a41aa92b0a2',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Pages/BulkPriceUpdate.php' => '3a8577bf580128713abaae48e527a6d675061d42a0c3f3ce0363d100cbbdf918',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Pages/Dashboard.php' => 'd310dbe09ebf449c289398e9f322fc9ef8a7a91aa07cc49ad591a6f9757ddf2d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/BlogCategories/BlogCategoryResource.php' => '8f9e8e140689f9e4b374c41cb5394818f44a95335103e557dc8b6f62c1ff5b31',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/BlogCategories/Pages/ManageBlogCategories.php' => '0a2aa4eaea7108f2ef9b3b1f5a01593c70acd3a5764fddb09d43dec6b471fd1a',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/BlogPosts/BlogPostResource.php' => '939c031af29bf45461d9d6f324b0ed16339919ea9f3aba3c450c6b21021c9f6f',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/BlogPosts/Pages/ManageBlogPosts.php' => '14f69fcaa6ad4c4a13603b5e923a531b894ef0e6c2108cfa4907f9956f5ab4f1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/BlogReplies/BlogReplyResource.php' => '2909a68a1c79cb0f5d61b6a85a7a1ae61c12edcb774a8defcc1397ba4fe3edab',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/BlogReplies/Pages/ManageBlogReplies.php' => '2ddb37fd84a87e49ecfdb442644560be5a590e234a96006818c5875d4b3e8316',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/CmsCategories/CmsCategoryResource.php' => '202e9f4f92cf81309baf2a2359e258661697d610d1c639cb503cad592d9f987e',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/CmsCategories/Pages/ManageCmsCategories.php' => 'e7e72b2b28c26cb92bd1b9ce82e96b1005324abdda2c88b9480916743eb7eed4',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/CmsPages/CmsPageResource.php' => '34192947f63c580e2dcdefbc97768c4a834562f95a666b5c265549071b928d21',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/CmsPages/Pages/ManageCmsPages.php' => '4bc0c9b489ad1657651a95c5e63538537190760383dd80ad753b6843597033ee',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ListProducts.php' => '7b718c75facf5945ab3a79b8c8a5959631556f6dc2ffeea9077804cae4484512',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Pages/ViewProduct.php' => '60413ac3919354686ea30344e70199b400c0c03caa2e5914c873e22f6126b731',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/ProductResource.php' => '922d2a86b35bebf40732d19505c6e550da62c00b0d4755f133ef8ba3ffa94194',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/RelationManagers/SpecificPricesRelationManager.php' => '9ecfc9d1c80054f16ae5a9f1814aaf4d378bf9f54403e4a87ac15571eff56266',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Schemas/ProductInfolist.php' => 'aa861faf354ead12a6210e7393d80637bc55cd297fbdbb8c778db6c338537681',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Resources/Products/Tables/ProductsTable.php' => 'e2f96ed1cb3188786b431e4db2b7eb3e7c99fc93f53217c8c179c8ba94d79759',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Widgets/ProductOverviewStats.php' => '3df769313a291a1ffd97b8dd0b1b3baddaf38d78f2028339390788a66c4fb238',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/App/Widgets/RecentProductsTable.php' => 'b3b1783a1dadcd05fada8ae80a64e2c6f576ea52b4c6cefb150e41092d2cadc3',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/CreateTenant.php' => '63348eeb003ee58759ecc655778cfe3af069968a5d8b50e2a9ebe67ebf1bc08a',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/EditTenant.php' => 'b9a4bfcdd7bc9c2d1ecef7ed0dd1a6c807a150a25d9daa9e83678d63d73246b9',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Pages/ListTenants.php' => 'fdd137cd4e629f036e7ccec7b23bb0ad8bb8a1c55585dee5149123e518549e3d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Schemas/TenantForm.php' => '02a01ec6a89f4b3a04b9be7d91de3ef12fdbfd61bd42e939d4cf67febb5cfc46',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/Tables/TenantsTable.php' => '9fb72d388578a85d3b7c57092061b044c9f01b3f98e5865fdaf83c9845fcd602',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Tenants/TenantResource.php' => 'c52d63dded369705d9ed8f056bc083a6b812039003a7f7661068368fb214ace0',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/CreateUser.php' => 'c6bb05dfd3550a1f53e5a4f951ef1eb7325c2bf02a14a554c7578529a6093e4e',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/EditUser.php' => '43d5f7297afdc2914b904e500106e4731ce862049cba3871cd5ea7f357dd94a4',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Pages/ListUsers.php' => 'aa7cad5b07ca26dcbc8bdc4db069e54809a6d73ae294ac03b10b13af0108c1b0',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Schemas/UserForm.php' => '88e702bdf52567dd79aaf7018e90459eba57a339508c97e39f78026c0e0734d0',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/Tables/UsersTable.php' => '63d1c9ece49439346b121e768f2893aff25b5db0a891235b1d072907e76f4966',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/Users/UserResource.php' => 'c7670c662f6643f3d3539e237f3d303b6a2aad941bd70e1e7b15242212fc582b',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Api/V1/ProductController.php' => '273adf948d98f248b10f6ff3f470835a5675e0f4d80f11d8444b233399c87643',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Controllers/Controller.php' => '25d1c1ef8e6cc8a376553faacfba2b07d9dfaee9bdbb84f14f77517580e9deb1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveFilamentTenant.php' => '25a869b5e3444013c02c391661393ef26cea14137aba3a7c08213ae82a4a5575',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Middleware/ResolveSaasTenant.php' => '05ed653db11f24c576bf0cec4929476919b539855f30965b210710ead66bb0b8',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Http/Requests/Api/V1/ListProductsRequest.php' => '8e73f751f1b4bc44de22374ab2af657591a012dc95eddc3669a9038c3cc52110',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/FinalizeBulkPriceUpdateJob.php' => 'f8bf06d0e32957d18278c19406b34da7f4d097e6b0e42de7e704b2283b8f73de',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ProcessBulkPriceUpdateChunkJob.php' => '7af13c56472eb16556e9fcb20b9fa220d4efe24224133114fc5166b39fffac98',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/ReindexTenantProductsJob.php' => '3acea9fef031f80f93309aa3a6cf07aabde9e72a9dfe2dc5761a08e90accb26c',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Jobs/StartBulkPriceUpdateJob.php' => '63724d20aa60a39c53064ec55c38f9bb50150630283c0b6d6b1ef35f67bd5a43',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/ApiToken.php' => '4039b671960d080bc1fca27d8c46e2bde40f4ef85d54c8f3bb539b83c1a58e1f',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/AuditLog.php' => 'c65be6c523af03cff912d974de87309e040bc865361ca0b6b150559447720265',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Job.php' => 'cf5270b1736f5ddd8aa17cd620c5eb40e9f4eda4d6a78855cad5480e362fc3d1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Revision.php' => 'a06169bcfd99babc9f7a9962f371088be94170392508cee35746a39b6bd7e56d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/Tenant.php' => '01b965b64b8e51fbcbdf7f4ac418790b23adfbcdcc086f32871a80db1cf573f3',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopProduct.php' => '35154048533c308b5ee1e511a5b86870aae19f3c777789ec01c386e60a7574e4',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/TenantPrestaShopSpecificPrice.php' => '5af80f67d96a712646023ca174c723f5a2d58d7bc8ae88276c54975a786207c4',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Models/User.php' => '9b1cfc5f68e085fa05706f8c2458e722dee23b7bbc85dd05c31e172d94ba8623',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/AppServiceProvider.php' => '670ea975de4af368b7bc06e9de600a58b90dce34d7f814b52864650b085d0e95',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/Filament/AdminPanelProvider.php' => '2b182358307f41d8eb21da5557aead10dec2d43f9a0a90c2084f733eb79fc15f',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Providers/Filament/AppPanelProvider.php' => '5551aa034364db10018aa498f45254e2ae531d4748ea4ae3f4a8beb952c0d20e',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/BulkPriceUpdateService.php' => '4cb4b5272b45208b7ddc5b8bacefb82920e86774aff881adf2d679c13d17ac5b',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/CmsPerformanceProbe.php' => '28c67aae5ddfcfec74afb8f2300c65c74c26e31e88fae7a06cfd8d0be844479d',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/PricingService.php' => 'db7f177750af257453b65626a539e36e489c5b2cd5ca1728c3f55adda63db2c0',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/ProductWriteService.php' => '2ce6d9d6ee6cbaf2a9dd82029686b02a3ea29ef2262091f97a40a46abb1430b1',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/RevisionService.php' => '8fa41f79149fc451f7f4795fbbcefc446f6a596c1d2ade3614e8c799cb827428',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantContext.php' => 'f01e97822a71d7535aa59aea63560c85157ca391c17b7e6a60b6f82f6f6f7297',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopBlogCategoryService.php' => '75936118ff8f3d25140f258721fb30e3bf113b40953093994213f4939f87aa4a',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopBlogPostService.php' => '4709c1f3d3f9953f07a656520cf2457c7cfa05a1dc1b86b38f230860ef88eda2',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopBlogReplyService.php' => '7ed127c3795b8b02f09394f9e2832b5b41319f1d573a3e9e24e56088835e4a66',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopCategoryService.php' => '86a8bced13d685e1dc99d6bee0b5447d4b8275eb3665e54934a61296f56a26a6',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopCmsCategoryService.php' => '0b9400280b968dee37b7d330f918569e7c6e21bd38194d4143ec4a9567f4061c',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopCmsPageService.php' => '3bff8c1fcbbadf33559a560395a9939fd7a7b93cf7a8b207bb7922a1da0086ca',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopConnection.php' => 'fce19d0ee333ef31b7404efe4d9ea962616d1665f7ef7b984c7d5435e459fd30',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopFeatureService.php' => '94d24a5b6bb394f210b434187693ef1e347d51c42264ab98bf19502032df8213',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopProductContentService.php' => 'db414e7c37c198f3e29bc5545dfabae5acecc68303dfdd9a31385099a7f0f509',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopProductEditorService.php' => 'bbdda30605a681b7da43f970d3a74b4bdd89e7e8b6b9d1484f283371d4068d7e',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantPrestaShopProductQueryBuilder.php' => '9081ae659d9b16b69ce2b0640a70b050d862500d53e0f991903196e5a47e1c8c',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TenantTypesenseProductBackfillService.php' => '22c709b0c0c0be855ada951e3b242d265a1e577386593723bea809e681ab0a11',
    '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Services/TypeSenseClient.php' => 'e167877a5dda42b7380de186904a9574ced5c1ffefc87d3ea657812667b993c0',
  ),
  'composerLocks' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/composer.lock' => '54c5f49a49081d30b60cf50f5a37813d80bc318221942dcaa7f8e219f8a50169',
  ),
  'composerInstalled' => 
  array (
    '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'blade-ui-kit/blade-heroicons' => 
        array (
          'pretty_version' => '2.7.0',
          'version' => '2.7.0.0',
          'reference' => '66fa8ba09dba12e0cdb410b8cb94f3b890eca440',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../blade-ui-kit/blade-heroicons',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'blade-ui-kit/blade-icons' => 
        array (
          'pretty_version' => '1.9.1',
          'version' => '1.9.1.0',
          'reference' => '377eede719f9690b03bbbfd516afef887e27634a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../blade-ui-kit/blade-icons',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'brianium/paratest' => 
        array (
          'pretty_version' => 'v7.20.0',
          'version' => '7.20.0.0',
          'reference' => '81c80677c9ec0ed4ef16b246167f11dec81a6e3d',
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
          'pretty_version' => '3.3.0',
          'version' => '3.3.0.0',
          'reference' => 'a0a487cbf5344f721eb504bf0f59bada40c381b7',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../chillerlan/php-settings-container',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'clue/stream-filter' => 
        array (
          'pretty_version' => 'v1.7.0',
          'version' => '1.7.0.0',
          'reference' => '049509fef80032cb3f051595029ab75b49a3c2f7',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../clue/stream-filter',
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
          'pretty_version' => 'v2.2.0',
          'version' => '2.2.0.0',
          'reference' => 'c03e649220089f6e5a52d422e24e3f98c73e456d',
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
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => '2de4a4ff59599c76c2ad4418b2a2ffdb50314408',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/actions',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/filament' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => 'bb070b71dc443e4c231e30a50cfb5d1a681a1c0b',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/filament',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/forms' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => '2f65bfc96448d9e6f60f905b46bc78ce1e903b24',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/forms',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/infolists' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => 'd67da624ed8daf176b7ac0303adf5b695faf307a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/infolists',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/notifications' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => '44944f1ec485caf36ca1e2ccadf5757fa44b5c87',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/notifications',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/query-builder' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => '31b53bcd79b3f7d4ce5c753f9a300a0594fc7ecd',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/query-builder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/schemas' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => 'ead604d3a994a8e3a49b38d9b5736f716859506c',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/schemas',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/support' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => '3382f959703e566c5ac8ad12307b7b75a42f8759',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/support',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/tables' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => 'f3205e51134ce0046bdba7eba4e82e3cb33e0b08',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../filament/tables',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'filament/widgets' => 
        array (
          'pretty_version' => 'v5.4.5',
          'version' => '5.4.5.0',
          'reference' => '9d015855538378f536156feb9d2af494fb236579',
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
          'pretty_version' => '2.9.0',
          'version' => '2.9.0.0',
          'reference' => '7d0ed42f28e42d61352a7a79de682e5e67fec884',
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
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/broadcasting' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/bus' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/cache' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/collections' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/concurrency' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/conditionable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/config' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/console' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/container' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/contracts' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/cookie' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/database' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/encryption' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/events' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/filesystem' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/hashing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/http' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/json-schema' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/log' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/macroable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/mail' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/notifications' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/pagination' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/pipeline' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/process' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/queue' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/redis' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/reflection' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/routing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/session' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/support' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/testing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/translation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/validation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
          ),
        ),
        'illuminate/view' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.56.0',
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
          'pretty_version' => '4.3.1',
          'version' => '4.3.1.0',
          'reference' => '3f77b096c1e8b5aa1fc40d7080e55e795f3430ae',
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
          'pretty_version' => 'v3.9.3',
          'version' => '3.9.3.0',
          'reference' => '64a52bcc5347c89fdf131cb59f96ebfbc8d1ad65',
          'type' => 'phpstan-extension',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../larastan/larastan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/boost' => 
        array (
          'pretty_version' => 'v2.4.2',
          'version' => '2.4.2.0',
          'reference' => '74fedf18048d382e04eded004abe2ad1ee1d9a97',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/boost',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/framework' => 
        array (
          'pretty_version' => 'v12.56.0',
          'version' => '12.56.0.0',
          'reference' => 'dac16d424b59debb2273910dde88eb7050a2a709',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/framework',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/mcp' => 
        array (
          'pretty_version' => 'v0.6.5',
          'version' => '0.6.5.0',
          'reference' => '583a6282bf0f074d754f7ff5cd1fff9d34244691',
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
          'pretty_version' => 'v1.29.0',
          'version' => '1.29.0.0',
          'reference' => 'bdec963f53172c5e36330f3a400604c69bf02d39',
          'type' => 'project',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/pint',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/prompts' => 
        array (
          'pretty_version' => 'v0.3.16',
          'version' => '0.3.16.0',
          'reference' => '11e7d5f93803a2190b00e145142cb00a33d17ad2',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/prompts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/roster' => 
        array (
          'pretty_version' => 'v0.5.1',
          'version' => '0.5.1.0',
          'reference' => '5089de7615f72f78e831590ff9d0435fed0102bb',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/roster',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/sail' => 
        array (
          'pretty_version' => 'v1.56.0',
          'version' => '1.56.0.0',
          'reference' => 'f43426bb42a1cb7a51a3861d9138063e54766d28',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/sail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/scout' => 
        array (
          'pretty_version' => 'v10.25.0',
          'version' => '10.25.0.0',
          'reference' => 'f28630dca44a63d80c15e596bedc5af42c8985d5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../laravel/scout',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/serializable-closure' => 
        array (
          'pretty_version' => 'v2.0.11',
          'version' => '2.0.11.0',
          'reference' => 'd1af40ac4a6ccc12bd062a7184f63c9995a63bdd',
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
          'pretty_version' => '2.8.2',
          'version' => '2.8.2.0',
          'reference' => '59fb075d2101740c337c7216e3f32b36c204218b',
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
          'pretty_version' => '3.33.0',
          'version' => '3.33.0.0',
          'reference' => '570b8871e0ce693764434b29154c54b434905350',
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
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '08cf38e3924d4f56238125547b5720496fac8fd4',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/uri',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri-components' => 
        array (
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '848ff9db2f0be06229d6034b7c2e33d41b4fd675',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/uri-components',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri-interfaces' => 
        array (
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '85d5c77c5d6d3af6c54db4a78246364908f3c928',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../league/uri-interfaces',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'livewire/livewire' => 
        array (
          'pretty_version' => 'v4.2.4',
          'version' => '4.2.4.0',
          'reference' => '7d0bfa46269b1ec186b8cdd38baffee5cc647d10',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../livewire/livewire',
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
          'pretty_version' => '3.11.4',
          'version' => '3.11.4.0',
          'reference' => 'e890471a3494740f7d9326d72ce6a8c559ffee60',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nesbot/carbon',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/php-generator' => 
        array (
          'pretty_version' => 'v4.2.2',
          'version' => '4.2.2.0',
          'reference' => '0d7060926f5c3e8c488b9b9ced42d857f12a34b5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nette/php-generator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/schema' => 
        array (
          'pretty_version' => 'v1.3.5',
          'version' => '1.3.5.0',
          'reference' => 'f0ab1a3cda782dbc5da270d28545236aa80c4002',
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
          'pretty_version' => 'v8.9.3',
          'version' => '8.9.3.0',
          'reference' => 'b0d8ab95b29c3189aeeb902d81215231df4c1b64',
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
        'nyholm/psr7' => 
        array (
          'pretty_version' => '1.8.2',
          'version' => '1.8.2.0',
          'reference' => 'a71f2b11690f4b24d099d6b16690a90ae14fc6f3',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../nyholm/psr7',
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
          'pretty_version' => 'v4.4.5',
          'version' => '4.4.5.0',
          'reference' => '9797a71dbc776f46d6fcacb708b002755da6f37a',
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
          'pretty_version' => 'v4.1.0',
          'version' => '4.1.0.0',
          'reference' => '3057a36669ff11416cc0dc2b521b3aec58c488d0',
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
        'php-http/async-client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
            1 => '1.0',
          ),
        ),
        'php-http/client-common' => 
        array (
          'pretty_version' => '2.7.3',
          'version' => '2.7.3.0',
          'reference' => 'dcc6de29c90dd74faab55f71b79d89409c4bf0c1',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../php-http/client-common',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'php-http/client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
            1 => '1.0',
          ),
        ),
        'php-http/curl-client' => 
        array (
          'pretty_version' => '2.4.0',
          'version' => '2.4.0.0',
          'reference' => 'f59d6992065f44be8b8fb484dd678a919c27dbf2',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../php-http/curl-client',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'php-http/discovery' => 
        array (
          'pretty_version' => '1.20.0',
          'version' => '1.20.0.0',
          'reference' => '82fe4c73ef3363caed49ff8dd1539ba06044910d',
          'type' => 'composer-plugin',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../php-http/discovery',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'php-http/httplug' => 
        array (
          'pretty_version' => '2.4.1',
          'version' => '2.4.1.0',
          'reference' => '5cad731844891a4c282f3f3e1b582c46839d22f4',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../php-http/httplug',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'php-http/message' => 
        array (
          'pretty_version' => '1.16.2',
          'version' => '1.16.2.0',
          'reference' => '06dd5e8562f84e641bf929bfe699ee0f5ce8080a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../php-http/message',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'php-http/message-factory-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'php-http/promise' => 
        array (
          'pretty_version' => '1.3.1',
          'version' => '1.3.1.0',
          'reference' => 'fc85b1fba37c169a69a07ef0d5a8075770cc1f83',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../php-http/promise',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
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
          'pretty_version' => '6.0.3',
          'version' => '6.0.3.0',
          'reference' => '7bae67520aa9f5ecc506d646810bd40d9da54582',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../phpdocumentor/reflection-docblock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/type-resolver' => 
        array (
          'pretty_version' => '2.0.0',
          'version' => '2.0.0.0',
          'reference' => '327a05bbee54120d4786a0dc67aad30226ad4cf9',
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
          'pretty_version' => '2.1.46',
          'version' => '2.1.46.0',
          'reference' => 'a193923fc2d6325ef4e741cf3af8c3e8f54dbf25',
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
          'pretty_version' => '12.5.16',
          'version' => '12.5.16.0',
          'reference' => 'b2429f58ae75cae980b5bb9873abe4de6aac8b58',
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
            0 => '*',
            1 => '1.0',
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
            0 => '*',
            1 => '1.0',
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
            0 => '*',
            1 => '1.0',
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
          'pretty_version' => 'v0.12.22',
          'version' => '0.12.22.0',
          'reference' => '3be75d5b9244936dd4ac62ade2bfb004d13acf0f',
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
          'pretty_version' => 'v1.1.1',
          'version' => '1.1.1.0',
          'reference' => '3f9e80b56ff60b78755ef320e3e16d88850101d6',
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
          'pretty_version' => '7.1.5',
          'version' => '7.1.5.0',
          'reference' => 'c284f55811f43d555e51e8e5c166ac40d3e33c63',
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
          'pretty_version' => '8.0.4',
          'version' => '8.0.4.0',
          'reference' => '7b8842c2d8e85d0c3a5831236bf5869af6ab2a11',
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
          'pretty_version' => '1.93.0',
          'version' => '1.93.0.0',
          'reference' => '0d097bce95b2bf6802fb1d83e1e753b0f5a948e7',
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
        'stechstudio/filament-impersonate' => 
        array (
          'pretty_version' => 'v5.1.0',
          'version' => '5.1.0.0',
          'reference' => 'c5d5b8b5150fad02db18c4479eafb9dc2f537ffc',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../stechstudio/filament-impersonate',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/clock' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => 'b55a638b189a6faa875e0ccdb00908fb87af95b3',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/console' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '1e92e39c51f95b88e3d66fa2d9f06d1fb45dd707',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/console',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/css-selector' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => '8db1c00226a94d8ab6aa89d9224eeee91e2ea2ed',
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
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '8dd79d8af777ee6cba2fd4d98da6ffb839f3c0fa',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/error-handler',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => 'f662acc6ab22a3d6d716dcb44c381c6002940df6',
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
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => 'e0be088d22278583a82da281886e8c3592fbf149',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/finder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/html-sanitizer' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => 'b0e4a2d9a82ab6bdcc742a63398781f6dae64fe5',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/html-sanitizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-foundation' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '9381209597ec66c25be154cbf2289076e64d1eab',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/http-foundation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-kernel' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '017e76ad089bac281553389269e259e155935e1a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/http-kernel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mailer' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => 'f6ea532250b476bfc1b56699b388a1bdbf168f62',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/mailer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mime' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '6df02f99998081032da3407a8d6c4e1dcb5d4379',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/mime',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/options-resolver' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => 'b48bce0a70b914f6953dafbd10474df232ed4de8',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/options-resolver',
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
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '60f19cd3badc8de688421e21e4305eba50f8089a',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/process',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/routing' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '9608de9873ec86e754fb6c0a0fa7e5f1a960eb6b',
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
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => 'ae9488f874d7603f9d2dfbf120203882b645d963',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/string',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => '27c03ae3940de24ba2f71cfdbac824f2aa1fdf2f',
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
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '6883ebdf7bf6a12b37519dbc0df62b0222401b56',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/uid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/var-dumper' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '9510c3966f749a1d1ff0059e1eabef6cc621e7fd',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../symfony/var-dumper',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/yaml' => 
        array (
          'pretty_version' => 'v8.0.8',
          'version' => '8.0.8.0',
          'reference' => '54174ab48c0c0f9e21512b304be17f8150ccf8f1',
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
        'typesense/typesense-php' => 
        array (
          'pretty_version' => 'v6.0.0',
          'version' => '6.0.0.0',
          'reference' => 'e113f90449e159316a433a5509205939f271c5e2',
          'type' => 'library',
          'install_path' => '/Users/fabionbaromeo/Herd/isb-presta-manager/vendor/composer/../typesense/typesense-php',
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
          'pretty_version' => '2.1.6',
          'version' => '2.1.6.0',
          'reference' => 'ff31ad6efc62e66e518fbab1cde3453d389bcdc8',
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
    '/Users/fabionbaromeo/Herd/isb-presta-manager/bootstrap/app.php' => 'e35a0658686f155665c7354103e7377f4e319f2d3ae0d553a0fe8af707d90222',
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
    6 => 'SPX',
    7 => 'SimpleXML',
    8 => 'Zend OPcache',
    9 => 'bcmath',
    10 => 'bz2',
    11 => 'calendar',
    12 => 'ctype',
    13 => 'curl',
    14 => 'date',
    15 => 'dba',
    16 => 'dom',
    17 => 'exif',
    18 => 'fileinfo',
    19 => 'filter',
    20 => 'ftp',
    21 => 'gd',
    22 => 'gettext',
    23 => 'gmp',
    24 => 'hash',
    25 => 'herd',
    26 => 'iconv',
    27 => 'igbinary',
    28 => 'imagick',
    29 => 'imap',
    30 => 'intl',
    31 => 'json',
    32 => 'ldap',
    33 => 'libxml',
    34 => 'mbstring',
    35 => 'mongodb',
    36 => 'mysqli',
    37 => 'mysqlnd',
    38 => 'openssl',
    39 => 'pcntl',
    40 => 'pcre',
    41 => 'pdo_mysql',
    42 => 'pdo_pgsql',
    43 => 'pdo_sqlite',
    44 => 'pdo_sqlsrv',
    45 => 'pgsql',
    46 => 'posix',
    47 => 'random',
    48 => 'readline',
    49 => 'redis',
    50 => 'session',
    51 => 'shmop',
    52 => 'soap',
    53 => 'sockets',
    54 => 'sodium',
    55 => 'sqlite3',
    56 => 'sqlsrv',
    57 => 'standard',
    58 => 'sysvmsg',
    59 => 'sysvsem',
    60 => 'sysvshm',
    61 => 'tokenizer',
    62 => 'xml',
    63 => 'xmlreader',
    64 => 'xmlwriter',
    65 => 'xsl',
    66 => 'zip',
    67 => 'zlib',
    68 => 'zstd',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/tests/Feature/ApiTokenResourceTest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'uses',
        1 => 17,
      ),
      1 => 
      array (
        0 => 'beforeEach',
        1 => 19,
      ),
      2 => 
      array (
        0 => 'it',
        1 => 23,
      ),
      3 => 
      array (
        0 => 'Pest\\Laravel\\actingAs',
        1 => 35,
      ),
      4 => 
      array (
        0 => 'Pest\\Laravel\\actingAs',
        1 => 40,
      ),
      5 => 
      array (
        0 => 'Pest\\Laravel\\actingAs',
        1 => 45,
      ),
      6 => 
      array (
        0 => 'it',
        1 => 51,
      ),
      7 => 
      array (
        0 => 'Pest\\Laravel\\actingAs',
        1 => 55,
      ),
      8 => 
      array (
        0 => 'it',
        1 => 81,
      ),
      9 => 
      array (
        0 => 'Pest\\Laravel\\actingAs',
        1 => 88,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'Pest\\Mixins\\Expectation',
        ),
        1 => 'toBeTrue',
        2 => 36,
      ),
      1 => 
      array (
        0 => 
        array (
          0 => 'Pest\\Mixins\\Expectation',
        ),
        1 => 'toBeFalse',
        2 => 41,
      ),
      2 => 
      array (
        0 => 
        array (
          0 => 'Pest\\Mixins\\Expectation',
        ),
        1 => 'toBeFalse',
        2 => 46,
      ),
      3 => 
      array (
        0 => 
        array (
          0 => 'Pest\\Mixins\\Expectation',
        ),
        1 => 'toBe',
        2 => 69,
      ),
      4 => 
      array (
        0 => 
        array (
          0 => 'Pest\\Mixins\\Expectation',
        ),
        1 => 'toBe',
        2 => 74,
      ),
      5 => 
      array (
        0 => 
        array (
          0 => 'Pest\\Mixins\\Expectation',
        ),
        1 => 'toBeFalse',
        2 => 95,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ApiToken',
        1 => 'issue',
        2 => 85,
      ),
    ),
  ),
); },
	'dependencies' => array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/ApiTokenResource.php' => 
  array (
    'fileHash' => '20be0022d421c0f4a3f44fe9515c70b59bdcbaddff9d92a1ff83f194a424784b',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Pages/CreateApiToken.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Pages/ListApiTokens.php',
      2 => '/Users/fabionbaromeo/Herd/isb-presta-manager/tests/Feature/ApiTokenResourceTest.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Pages/CreateApiToken.php' => 
  array (
    'fileHash' => '91bbb160e092b458d6f2ccb92fb9d1827d01d8b05c6ca62a4c9ad817ed9a8fb2',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/ApiTokenResource.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/tests/Feature/ApiTokenResourceTest.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Pages/ListApiTokens.php' => 
  array (
    'fileHash' => '6be2f406281873404009e7db6d205920ca661c4071d96545b1349c13c542cfd7',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/ApiTokenResource.php',
      1 => '/Users/fabionbaromeo/Herd/isb-presta-manager/tests/Feature/ApiTokenResourceTest.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Schemas/ApiTokenForm.php' => 
  array (
    'fileHash' => 'b686b271d912c131823c09e54b5d7422be745b72e77b97a4f998ae7dd53bacdb',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/ApiTokenResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Tables/ApiTokensTable.php' => 
  array (
    'fileHash' => 'de8bdbb5a97d7fea852758fbd4d88aa0accce7c98193b0a21e96df7b41a5a346',
    'dependentFiles' => 
    array (
      0 => '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/ApiTokenResource.php',
    ),
  ),
  '/Users/fabionbaromeo/Herd/isb-presta-manager/tests/Feature/ApiTokenResourceTest.php' => 
  array (
    'fileHash' => '489d4ce78ae1905cdcf30407e6cb4bf1ad204b5188252c3846b5af7765017f7c',
    'dependentFiles' => 
    array (
    ),
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/ApiTokenResource.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\ApiTokens\\ApiTokenResource',
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
             'namespace' => 'App\\Filament\\Resources\\ApiTokens',
             'uses' => 
            array (
              'createapitoken' => 'App\\Filament\\Resources\\ApiTokens\\Pages\\CreateApiToken',
              'listapitokens' => 'App\\Filament\\Resources\\ApiTokens\\Pages\\ListApiTokens',
              'apitokenform' => 'App\\Filament\\Resources\\ApiTokens\\Schemas\\ApiTokenForm',
              'apitokenstable' => 'App\\Filament\\Resources\\ApiTokens\\Tables\\ApiTokensTable',
              'apitoken' => 'App\\Models\\ApiToken',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Pages/CreateApiToken.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\ApiTokens\\Pages\\CreateApiToken',
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
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'canCreateAnother',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
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
            0 => 'generatedPlainTextToken',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
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
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handleRecordCreation',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array{tenant_id:int|string,name:string,abilities?:array<int, string>}  $data
     */',
             'namespace' => 'App\\Filament\\Resources\\ApiTokens\\Pages',
             'uses' => 
            array (
              'apitokenresource' => 'App\\Filament\\Resources\\ApiTokens\\ApiTokenResource',
              'apitoken' => 'App\\Models\\ApiToken',
              'notification' => 'Filament\\Notifications\\Notification',
              'createrecord' => 'Filament\\Resources\\Pages\\CreateRecord',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
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
           'returnType' => 'Illuminate\\Database\\Eloquent\\Model',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
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
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getCreatedNotification',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?Filament\\Notifications\\Notification',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Pages/ListApiTokens.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\ApiTokens\\Pages\\ListApiTokens',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Schemas/ApiTokenForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\ApiTokens\\Schemas\\ApiTokenForm',
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
  '/Users/fabionbaromeo/Herd/isb-presta-manager/app/Filament/Resources/ApiTokens/Tables/ApiTokensTable.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Filament\\Resources\\ApiTokens\\Tables\\ApiTokensTable',
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
); },
];
