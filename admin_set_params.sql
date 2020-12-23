/* **************************************
@author Evan Pomponio
@file admin_set_params
Function to genereate query that updates mining settings
@date 12/2/20
************************************** */


CREATE OR REPLACE FUNCTION upd_settings(max_rule_len IN NUMBER, min_support IN NUMBER, min_confidence IN NUMBER) 
RETURN VARCHAR2 IS
 s VARCHAR2(500);
 BEGIN
 s:= 'UPDATE SETTINGS_ASSOCIATION_RULES SET SETTING_VALUE = ' ||  max_rule_len;
 s:= s || ' WHERE SETTING_NAME DBMS_DATA_MINING.ASSO_MAX_RULE_LENGTH;';
 s:= s || chr(10);
 s:= s || 'UPDATE SETTINGS_ASSOCIATION_RULES ';
 s:= s || 'SET SETTING_VALUE = ' ||  min_support;
 s:= s || ' WHERE SETTING_NAME DBMS_DATA_MINING.ASSO_MIN_SUPPORT;';
 s:= s || chr(10);
 s:= s || 'UPDATE SETTINGS_ASSOCIATION_RULES ';
 s:= s || 'SET SETTING_VALUE = ' ||  min_confidence ;
 s:= s || ' WHERE SETTING_NAME DBMS_DATA_MINING.ASSO_MIN_CONFIDENCE;';
 s:= s || chr(10);
 s:= s || 'INSERT INTO SETTINGS_ASSOCIATION_RULES ';
 s:= s || ' VALUES (DBMS_DATA_MINING.ODMS_ITEM_ID_COLUMN_NAME, "REACTION");';
 return s;
 END;
