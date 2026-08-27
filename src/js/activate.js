/**
 * @copyright Copyright (c) 2026 T-Systems International
 * SPDX-License-Identifier: AGPL-3.0-or-later
 *
 * Auto-opens the notice on load. p013 seam: the listener gates whether this is
 * injected. `main` runs first (module order) and has defined the open handle.
 */

document.addEventListener('DOMContentLoaded', function() {
	window.OCA?.NMC_Migration_Notice?.open?.()
})
