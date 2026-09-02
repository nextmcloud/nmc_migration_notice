/**
 * SPDX-FileCopyrightText: 2026 T-Systems International
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

import { createAppConfig } from '@nextcloud/vite-config'
import { join } from 'node:path'

export default createAppConfig({
	main: join(__dirname, 'src', 'main.js'),
	activate: join(__dirname, 'src', 'js', 'activate.js'),
	// Temporary demo trigger — remove once the gated p013 feature is in place.
	demo: join(__dirname, 'src', 'js', 'demo.js'),
}, {
	thirdPartyLicense: false,
	config: {
		build: {
			// Bundle all component styles into a single injected stylesheet.
			cssCodeSplit: false,
		},
	},
})
