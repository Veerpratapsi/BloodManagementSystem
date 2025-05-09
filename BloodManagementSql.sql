USE [master]
GO
/****** Object:  Database [Blood_Management_System]    Script Date: 22-04-2025 22:36:19 ******/
CREATE DATABASE [Blood_Management_System]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Blood_Management_System', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\Blood_Management_System.mdf' , SIZE = 4096KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'Blood_Management_System_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.SQLEXPRESS\MSSQL\DATA\Blood_Management_System_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [Blood_Management_System] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Blood_Management_System].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Blood_Management_System] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Blood_Management_System] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Blood_Management_System] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Blood_Management_System] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Blood_Management_System] SET ARITHABORT OFF 
GO
ALTER DATABASE [Blood_Management_System] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [Blood_Management_System] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [Blood_Management_System] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Blood_Management_System] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Blood_Management_System] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Blood_Management_System] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Blood_Management_System] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Blood_Management_System] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Blood_Management_System] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Blood_Management_System] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Blood_Management_System] SET  DISABLE_BROKER 
GO
ALTER DATABASE [Blood_Management_System] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Blood_Management_System] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Blood_Management_System] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Blood_Management_System] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Blood_Management_System] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Blood_Management_System] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Blood_Management_System] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Blood_Management_System] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [Blood_Management_System] SET  MULTI_USER 
GO
ALTER DATABASE [Blood_Management_System] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Blood_Management_System] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Blood_Management_System] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Blood_Management_System] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [Blood_Management_System]
GO
/****** Object:  Table [dbo].[admins]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[admins](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](50) NOT NULL,
	[password] [nvarchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[BloodInventory]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[BloodInventory](
	[BloodID] [int] IDENTITY(1,1) NOT NULL,
	[BloodType] [varchar](10) NULL,
	[Quantity] [int] NULL,
	[EntryDate] [date] NULL,
	[Status] [varchar](20) NULL DEFAULT ('Available'),
PRIMARY KEY CLUSTERED 
(
	[BloodID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[hospital_login]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[hospital_login](
	[login_id] [int] IDENTITY(1,1) NOT NULL,
	[h_id] [int] NULL,
	[email] [varchar](255) NOT NULL,
	[password] [varchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[login_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_approved_requests]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_approved_requests](
	[R_a_id] [int] IDENTITY(1,1) NOT NULL,
	[H_R_id] [int] NOT NULL,
	[h_id] [int] NOT NULL,
	[Requested_qnt] [int] NOT NULL,
	[H_R_BloodGrp] [varchar](10) NOT NULL,
	[Fulfill_till] [datetime] NOT NULL,
	[ApprovedAt] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[R_a_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_Donor]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Donor](
	[D_name] [nvarchar](50) NOT NULL,
	[D_bloodtype] [nchar](10) NOT NULL,
	[D_age] [int] NOT NULL,
	[D_gender] [nchar](10) NOT NULL,
	[D_identification] [ntext] NOT NULL,
	[D_medical] [ntext] NOT NULL,
	[D_contact] [nchar](10) NOT NULL,
	[D_email] [text] NULL,
	[D_address] [ntext] NOT NULL,
	[D_id] [int] IDENTITY(1,1) NOT NULL,
	[D_Last_Donation] [text] NULL,
 CONSTRAINT [PK_tb_Donor] PRIMARY KEY CLUSTERED 
(
	[D_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tb_H_Request]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_H_Request](
	[H_id] [int] NULL,
	[H_R_BloodGrp] [nchar](10) NULL,
	[Fulfill_till] [date] NULL,
	[Requested_qnt] [ntext] NULL,
	[h_r_id] [int] IDENTITY(1,1) NOT NULL,
	[status] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[h_r_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_Hospital]    Script Date: 22-04-2025 22:36:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_Hospital](
	[H_name] [nvarchar](50) NOT NULL,
	[H_contact] [nvarchar](50) NOT NULL,
	[H_email] [nvarchar](50) NULL,
	[H_address] [ntext] NOT NULL,
	[H_con_person] [varchar](50) NULL,
	[h_id] [int] IDENTITY(1,1) NOT NULL,
	[password] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[h_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[tb_approved_requests] ADD  DEFAULT (getdate()) FOR [ApprovedAt]
GO
ALTER TABLE [dbo].[tb_H_Request] ADD  DEFAULT ('pending') FOR [status]
GO
ALTER TABLE [dbo].[hospital_login]  WITH CHECK ADD FOREIGN KEY([h_id])
REFERENCES [dbo].[tb_Hospital] ([h_id])
GO
ALTER TABLE [dbo].[tb_approved_requests]  WITH CHECK ADD  CONSTRAINT [FK_h_id] FOREIGN KEY([h_id])
REFERENCES [dbo].[tb_Hospital] ([h_id])
GO
ALTER TABLE [dbo].[tb_approved_requests] CHECK CONSTRAINT [FK_h_id]
GO
ALTER TABLE [dbo].[tb_approved_requests]  WITH CHECK ADD  CONSTRAINT [FK_H_R_id] FOREIGN KEY([H_R_id])
REFERENCES [dbo].[tb_H_Request] ([h_r_id])
GO
ALTER TABLE [dbo].[tb_approved_requests] CHECK CONSTRAINT [FK_H_R_id]
GO
ALTER TABLE [dbo].[tb_H_Request]  WITH CHECK ADD  CONSTRAINT [fk_tb_h_request_h_id] FOREIGN KEY([H_id])
REFERENCES [dbo].[tb_Hospital] ([h_id])
GO
ALTER TABLE [dbo].[tb_H_Request] CHECK CONSTRAINT [fk_tb_h_request_h_id]
GO
USE [master]
GO
ALTER DATABASE [Blood_Management_System] SET  READ_WRITE 
GO
