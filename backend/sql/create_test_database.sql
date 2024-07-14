-- Drop the test database if it already exists
USE master;
GO
IF EXISTS (SELECT * FROM sys.databases WHERE name = 'StackOverflow2013_test')
BEGIN
    ALTER DATABASE StackOverflow2013_test SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
    DROP DATABASE StackOverflow2013_test;
END
GO

-- Create the test database
CREATE DATABASE StackOverflow2013_test;
GO

-- Connect to the StackOverflow2013_test database to create the user
USE [StackOverflow2013_test];
GO

-- Create a user for the login in the StackOverflow2013_test database
CREATE USER explorer FOR LOGIN explorer;
GO

-- Grant the user SELECT, INSERT, UPDATE, and DELETE permissions on the database
GRANT SELECT, INSERT, UPDATE, DELETE TO explorer;
GO

USE [StackOverflow2013_test];
GO

/****** Object:  Table [dbo].[Users]    Script Date: 7/14/2024 4:58:40 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Users](
    [Id] [int] IDENTITY(1,1) NOT NULL,
    [AboutMe] [nvarchar](max) NULL,
    [Age] [int] NULL,
    [CreationDate] [datetime] NOT NULL,
    [DisplayName] [nvarchar](40) NOT NULL,
    [DownVotes] [int] NOT NULL,
    [EmailHash] [nvarchar](40) NULL,
    [LastAccessDate] [datetime] NOT NULL,
    [Location] [nvarchar](100) NULL,
    [Reputation] [int] NOT NULL,
    [UpVotes] [int] NOT NULL,
    [Views] [int] NOT NULL,
    [WebsiteUrl] [nvarchar](200) NULL,
    [AccountId] [int] NULL,
    CONSTRAINT [PK_Users_Id] PRIMARY KEY CLUSTERED
(
[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

-- Populate table with test data
USE [StackOverflow2013_test];
GO

INSERT INTO [dbo].[Users]
           ([AboutMe]
           ,[Age]
           ,[CreationDate]
           ,[DisplayName]
           ,[DownVotes]
           ,[EmailHash]
           ,[LastAccessDate]
           ,[Location]
           ,[Reputation]
           ,[UpVotes]
           ,[Views]
           ,[WebsiteUrl]
           ,[AccountId])
     VALUES
           ('Software developer with a passion for coding and learning new technologies.'
           ,30
           ,'2023-01-01 10:00:00'
           ,'JohnDoe'
           ,5
           ,'d41d8cd98f00b204e9800998ecf8427e'
           ,'2023-06-01 14:00:00'
           ,'New York, NY'
           ,1500
           ,300
           ,100
           ,'https://johndoe.dev'
           ,1)
GO

INSERT INTO [dbo].[Users]
           ([AboutMe]
           ,[Age]
           ,[CreationDate]
           ,[DisplayName]
           ,[DownVotes]
           ,[EmailHash]
           ,[LastAccessDate]
           ,[Location]
           ,[Reputation]
           ,[UpVotes]
           ,[Views]
           ,[WebsiteUrl]
           ,[AccountId])
     VALUES
           ('Enthusiastic data scientist and machine learning expert.'
           ,28
           ,'2022-05-15 08:30:00'
           ,'JaneSmith'
           ,3
           ,'098f6bcd4621d373cade4e832627b4f6'
           ,'2023-07-01 09:45:00'
           ,'San Francisco, CA'
           ,2000
           ,500
           ,200
           ,'https://janesmith.ai'
           ,2)
GO
