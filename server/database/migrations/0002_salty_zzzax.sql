CREATE TABLE `invoices` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`credit_card_id` integer NOT NULL,
	`reference` text(7) NOT NULL,
	`limit` integer NOT NULL,
	`status` text DEFAULT 'open',
	`closing_day` integer NOT NULL,
	`due_day` integer NOT NULL,
	`created_at` text DEFAULT CURRENT_TIMESTAMP NOT NULL,
	`updated_at` text DEFAULT CURRENT_TIMESTAMP NOT NULL,
	`deleted_at` text,
	FOREIGN KEY (`credit_card_id`) REFERENCES `credit_cards`(`id`) ON UPDATE no action ON DELETE restrict
);
