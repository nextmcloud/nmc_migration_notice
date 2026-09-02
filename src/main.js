/**
 * @copyright Copyright (c) 2026 T-Systems International
 *
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

import Vue from 'vue'
import { translate, translatePlural } from '@nextcloud/l10n'

import App from './App.vue'

Vue.prototype.t = translate
Vue.prototype.n = translatePlural

const el = document.createElement('div')
el.id = 'nmc_migration_notice'
document.querySelector('body').appendChild(el)

const View = Vue.extend(App)
const vm = new View().$mount(el)

window.OCA = window.OCA || {}
window.OCA.NMC_Migration_Notice = window.OCA.NMC_Migration_Notice || {}
window.OCA.NMC_Migration_Notice.open = vm.open
