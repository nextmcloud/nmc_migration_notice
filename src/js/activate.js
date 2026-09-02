/**
 * @copyright Copyright (c) 2026 T-Systems International
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

import { loadState } from '@nextcloud/initial-state'

document.addEventListener('DOMContentLoaded', () => {
	const showMigrationNotice = loadState(
		'nmc_migration_notice',
		'showMigrationNotice',
		false,
	)

	if (!showMigrationNotice) {
		return
	}

	window.OCA?.NMC_Migration_Notice?.open?.()
})