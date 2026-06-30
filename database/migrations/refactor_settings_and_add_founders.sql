-- Migration: Refactor Settings and Add Founders
-- Date: 2026-07-01

-- Step 1: Remove founder_name and founder_photo from settings table
ALTER TABLE settings DROP COLUMN IF EXISTS founder_name;
ALTER TABLE settings DROP COLUMN IF EXISTS founder_photo;

-- Step 2: Change address to google_maps_embed
ALTER TABLE settings CHANGE COLUMN address google_maps_embed TEXT;

-- Step 3: Create founders table
CREATE TABLE IF NOT EXISTS founders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    whatsapp VARCHAR(30) DEFAULT NULL,
    instagram VARCHAR(100) DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
