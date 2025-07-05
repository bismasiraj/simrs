USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D03_Grafik_Kamar_GTerpakai]    Script Date: 13/03/2018 17:33:11 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D03_Grafik_Kamar_GTerpakai]
AS  
BEGIN  
SELECT COUNT(no_registration) AS TERISI , C.NAME_OF_CLINIC FROM treatment_akomodasi pv RIGHT join CLASS_ROOM on
         pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID  and pv.class_room_id is not null
		 and (pv.keluar_id = 0 or pv.keluar_id=33)        RIGHT join CLINIC C ON
		 CLASS_ROOM.CLINIC_ID = C.CLINIC_ID AND C.STYPE_ID IN (3)

WHERE C.STYPE_ID IN (3)
GROUP BY C.NAME_OF_CLINIC

END  
GO

