<template>
	<NcModal
		v-if="showModal"
		id="nmc_migration_notice"
		class="nmc-migration-notice"
		size="normal"
		:has-next="false"
		:has-previous="false"
		label-id="nmc-migration-notice-title"
		@close="close">
		<div class="migration-notice__content">
			<div class="migration-notice__eyebrow">
				<span class="migration-notice__badge" aria-hidden="true">!</span>
				<span class="migration-notice__eyebrow-text">
					{{ t('nmc_migration_notice', 'Important notice') }}
				</span>
			</div>

			<h2 id="nmc-migration-notice-title" class="migration-notice__title">
				{{ t('nmc_migration_notice', 'Contractual changes to your Inclusive offer') }}
			</h2>

			<p class="migration-notice__message">
				{{ t('nmc_migration_notice', 'The Terms and Conditions for your Inclusive offer have changed. Please open Telekom Mail and follow the instructions provided there to accept the updated Terms and Conditions.') }}
			</p>

			<p class="migration-notice__deadline" role="note">
				{{ t('nmc_migration_notice', 'If you do not accept the updated Terms and Conditions within the specified period, your MagentaCLOUD account may be deleted.') }}
			</p>

			<div class="migration-notice__actions">
				<NcButton
					type="secondary"
					:aria-label="t('nmc_migration_notice', 'Remind me later')"
					@click="close">
					{{ t('nmc_migration_notice', 'Remind me later') }}
				</NcButton>
				<NcButton
					type="primary"
					:aria-label="t('nmc_migration_notice', 'Open Telekom Mail')"
					@click="openMail">
					{{ t('nmc_migration_notice', 'Open Telekom Mail') }}
				</NcButton>
			</div>
		</div>
	</NcModal>
</template>

<script>
import NcModal from '@nextcloud/vue/dist/Components/NcModal.js'
import NcButton from '@nextcloud/vue/dist/Components/NcButton.js'

// TODO: source the target URL from app config / initial-state in production.
const TELEKOM_MAIL_URL = 'https://mail.telekom.de/'

export default {
	name: 'App',
	components: {
		NcModal,
		NcButton,
	},
	data() {
		return {
			showModal: false,
		}
	},
	methods: {
		open() {
			this.showModal = true
		},
		close() {
			this.showModal = false
		},
		openMail() {
			window.open(TELEKOM_MAIL_URL, '_blank', 'noopener,noreferrer')
		},
	},
}
</script>

<style>
/* Unscoped + !important: override NcModal's own root/close elements, which
   scoped styles can't reach, without affecting other dialogs. */

/* Match the app-standard dialog overlay instead of NcModal's darker default. */
#nmc_migration_notice.modal-mask,
.nmc-migration-notice.modal-mask {
	background-color: var(--nmc-color-main-background-mask) !important;
}

/* Clear the close button of the rounded top strip. */
#nmc_migration_notice .modal-container__close {
	top: 1.5rem !important;
	right: 1rem !important;
}
</style>

<style lang="scss" scoped>
.migration-notice__content {
	display: flex;
	flex-direction: column;
	gap: 16px;
	padding: 24px 28px 28px;
	// Stop long German compounds overflowing on narrow viewports.
	overflow-wrap: break-word;
	hyphens: auto;
	// Magenta accent strip; round top corners to match the card.
	border-top: 4px solid var(--color-primary);
	border-start-start-radius: var(--border-radius-container, var(--border-radius-rounded));
	border-start-end-radius: var(--border-radius-container, var(--border-radius-rounded));
}

.migration-notice__eyebrow {
	display: flex;
	align-items: center;
	gap: 12px;
}

.migration-notice__badge {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 32px;
	height: 32px;
	border-radius: 50%;
	font-weight: 700;
	color: var(--color-primary);
	background-color: var(--color-primary-element-light, var(--color-background-hover));
}

.migration-notice__eyebrow-text {
	font-size: 0.8125rem;
	font-weight: 700;
	letter-spacing: 0.05em;
	text-transform: uppercase;
	color: var(--color-primary);
}

.migration-notice__title {
	margin: 0;
	font-size: 1.5rem;
	line-height: 1.3;
	font-weight: 700;
	color: var(--color-main-text);
}

.migration-notice__message {
	margin: 0;
	color: var(--color-main-text);
	line-height: 1.5;
}

.migration-notice__deadline {
	margin: 0;
	padding: 16px;
	border-radius: var(--border-radius-large, 8px);
	// Amber caution callout; Telekom tokens are dark-mode aware, hex is fallback.
	border-inline-start: 4px solid var(--telekom-color-additional-yellow-500, #f1b125);
	background-color: var(--telekom-color-additional-yellow-subtle, #fcefd3);
	color: var(--telekom-color-text-and-icon-on-subtle-yellow, #ac5600);
	line-height: 1.5;
}

.migration-notice__actions {
	display: flex;
	flex-wrap: wrap;
	justify-content: flex-end;
	gap: 12px;
	margin-top: 8px;
}

@media (max-width: 512px) {
	.migration-notice__content {
		padding: 20px;
	}

	.migration-notice__title {
		font-size: 1.3125rem;
	}

	.migration-notice__actions {
		flex-direction: column-reverse;

		:deep(.button-vue) {
			width: 100%;
		}
	}
}
</style>
