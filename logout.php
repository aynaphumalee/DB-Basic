<?php
session_start();

unset($_SESSION);
session_unset();
?>
<script language="javascript">
    document.location="index.php";
</script>