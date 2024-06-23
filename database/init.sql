IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'stackoverflow')
    BEGIN
        CREATE DATABASE stackoverflow;
    END;
GO

USE stackoverflow;
GO

-- Add initial schema and data here