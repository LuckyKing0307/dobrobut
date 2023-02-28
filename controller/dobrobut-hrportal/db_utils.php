<?php

require_once "utils.php";

function pg_commit_or_rollback($aConn,$aResults): bool
{
    if (ch_mlpl($aResults)) {
        $res =  @pg_query($aConn,'COMMIT');
    } else {
        $res = @pg_query($aConn,'ROLLBACK');
    }
    if ($res !== false ) {$res = true;}
    return $res;
}

/**
 * @throws Exception
 */
function get_sequence_val($aConn, $aSequence): int
{
   $res = @pg_query($aConn,"Select nextval('".$aSequence."') ");
   if ($res !== false) {
       $row = @pg_fetch_row($res);
       try {
           if (is_array($row)) {
               return $row[0];
           }
       } catch (Exception $e) {
           throw new Exception(em('DB-0001','Get sequence ['.$aSequence.'] nextval error: Fetch dataa'));
       }

   } else {
       $error = @pg_last_error($aConn);
       throw new Exception(em('DB-0001','Get sequence ['.$aSequence.'] nextval error: '.$error));
   }
}
