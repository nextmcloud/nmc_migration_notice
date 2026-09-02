<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2026 T-Systems International
 *
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\NMC_Migration_Notice\AppInfo;

use OCA\NMC_Migration_Notice\Listener\BeforeTemplateRenderedListener;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;

class Application extends App implements IBootstrap {

	public const APP_ID = 'nmc_migration_notice';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	public function register(IRegistrationContext $context): void {
		$context->registerEventListener(BeforeTemplateRenderedEvent::class, BeforeTemplateRenderedListener::class);
	}

	public function boot(IBootContext $context): void {
	}
}
