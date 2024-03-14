CREATE TABLE `credit_cards` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`label` text(50) NOT NULL,
	`limit` integer NOT NULL,
	`account_id` integer NOT NULL,
	`closing_day` integer NOT NULL,
	`due_day` integer NOT NULL,
	`created_at` text DEFAULT CURRENT_TIMESTAMP NOT NULL,
	`updated_at` text DEFAULT CURRENT_TIMESTAMP NOT NULL,
	FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`) ON UPDATE no action ON DELETE restrict
);
