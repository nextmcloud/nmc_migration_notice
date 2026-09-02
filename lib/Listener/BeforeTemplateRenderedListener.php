<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2026 T-Systems International
 *
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\NMC_Migration_Notice\Listener;

use OCA\NMC_Migration_Notice\AppInfo\Application;
use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;
use OCP\AppFramework\Services\IInitialState;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\ISession;
use OCP\IUser;
use OCP\IUserSession;

class BeforeTemplateRenderedListener implements IEventListener {

	public function __construct(
		private IInitialState $initialState,
		private ISession $session,
		private IUserSession $userSession,
	) {
	}

	public function handle(Event $event): void {
		if (!$event instanceof BeforeTemplateRenderedEvent || !$event->isLoggedIn()) {
			return;
		}

		$user = $this->userSession->getUser();
		if (!$user instanceof IUser) {
			return;
		}

		$p013 = $this->session->get('nmc_migration_notice.p013') === true;
		$alreadyShown = $this->session->get('nmc_migration_notice.shown') === true;

		$showMigrationNotice = $p013 && !$alreadyShown;

		$this->initialState->provideInitialState(
			'showMigrationNotice',
			$showMigrationNotice,
		);

		if ($showMigrationNotice) {
			$this->session->set('nmc_migration_notice.shown', true);
		}

		// Mounts the modal and exposes the open handle; inert until open() is called.
		\OCP\Util::addScript(Application::APP_ID, Application::APP_ID . '-main');

		// Trigger the modal to open if the migration notice should be shown.
		\OCP\Util::addScript(Application::APP_ID, Application::APP_ID . '-activate');

		\OCP\Util::addStyle(Application::APP_ID, Application::APP_ID . '-style');
	}
}
