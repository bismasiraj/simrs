USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D15_Transaksi_Pasien]    Script Date: 13/03/2018 17:34:43 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D15_Transaksi_Pasien]
AS  
BEGIN  

SELECT

		c.NAME_OF_CLINIC,
		c.CLINIC_ID,
		sum(tagihan) as tagihan,
		sum(bayar) as BAYAR ,
		sum(retur) as retur

FROM TREATMENT_bill tb,clinic c  WHERE
c.clinic_id = tb.clinic_id and
year(TREAT_DATE) = year(getdate()) and month(TREAT_DATE) = month(getdate()) and day(TREAT_DATE) = day(getdate())
group by c.stype_id,c.clinic_id,c.name_of_clinic
order by stype_id,name_of_clinic





END  
GO

