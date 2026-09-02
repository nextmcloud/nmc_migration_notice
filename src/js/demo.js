/**
 * @copyright Copyright (c) 2026 T-Systems International
 * SPDX-License-Identifier: AGPL-3.0-or-later
 *
 * Temporary demo trigger: a button that opens the notice. Remove with its vite
 * entry and the listener's addScript once p013 lands.
 */

import { translate as t } from '@nextcloud/l10n'

document.addEventListener('DOMContentLoaded', function() {
	window.OCA = window.OCA || {}
	window.OCA.NMC_Migration_Notice = window.OCA.NMC_Migration_Notice || {}

	const button = document.createElement('button')
	button.id = 'nmc_migration_notice-demo-button'
	button.type = 'button'
	button.textContent = t('nmc_migration_notice', 'Show migration notice')
	button.style.cssText = [
		'position:fixed',
		'inset-block-end:16px',
		'inset-inline-end:16px',
		'z-index:2000',
		'padding:8px 16px',
		'border:none',
		'border-radius:var(--border-radius-pill, 100px)',
		'background-color:var(--color-primary-element, var(--color-primary))',
		'color:var(--color-primary-element-text, #fff)',
		'font-weight:600',
		'cursor:pointer',
		'box-shadow:0 2px 8px rgba(0, 0, 0, 0.25)',
	].join(';')

	button.addEventListener('click', function() {
		window.OCA?.NMC_Migration_Notice?.open?.()
	})

	document.body.appendChild(button)
})
