-- Raw SQL seeder to create roles, a company, and a SuperAdmin user
INSERT INTO roles (id, name) VALUES (1, 'SuperAdmin'), (2, 'Admin'), (3, 'Member'), (4, 'Sales'), (5, 'Manager');

INSERT INTO companies (id, name, created_at, updated_at) VALUES (1, 'Default Company', datetime('now'), datetime('now'));

/* NOTE: Laravel stores password hashes via bcrypt. Insert a hashed password for 'password'.
   Example bcrypt('password') -> replace below with actual hash produced by bcrypt on your machine. */

INSERT INTO users (id, name, email, password, company_id, role_id, created_at, updated_at)
VALUES (1, 'Super Admin', 'superadmin@example.com', '$2y$10$examplehashreplace', 1, 1, datetime('now'), datetime('now'));
