USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D06_Top_Obat_Rajal]    Script Date: 13/03/2018 17:33:37 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D06_Top_Obat_Rajal]
AS  
BEGIN  
    select TOP (10) T.brand_id,t.description, sum(T.quantity) as jml
	 from treatment_obat T
	 where racikan in (0,1,2,3,4)
	 and year(TREAT_DATE)  =  year(getdate() ) and
month(TREAT_DATE)  =  month(getdate()) and
day(treat_date)  =  day(getdate())
         and T.brand_id is not null
    and isrj =1
and brand_id in (select Brand_id from goods where isalkes <> 1)
	 group by t.DESCRIPTION,T.brand_id
order by sum(T.quantity) desc
END  
GO

