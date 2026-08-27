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
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\IUser;
use OCP\IUserSession;

class BeforeTemplateRenderedListener implements IEventListener {

	public function __construct(
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

		// Mounts the modal and exposes the open handle; inert until open() is called.
		\OCP\Util::addScript(Application::APP_ID, Application::APP_ID . '-main');

		// TODO(p013): re-enable and gate on migrated-Inclusive eligibility to auto-open.
		// \OCP\Util::addScript(Application::APP_ID, Application::APP_ID . '-activate');

		// Temporary demo trigger — remove once p013 lands.
		\OCP\Util::addScript(Application::APP_ID, Application::APP_ID . '-demo');

		\OCP\Util::addStyle(Application::APP_ID, Application::APP_ID . '-style');
	}
}
