<?php

use app\config\FireBase;

?>
<script src="<?=FireBase::URL_SCRIPT?>"></script>
<script>
  // Inicialización de firebase api
  var config = {
    apiKey: "<?=FireBase::API_KEY?>",
    authDomain: "<?=FireBase::AUTH_DOMAIN?>",
    databaseURL: "<?=FireBase::DATABASE_URL?>",
    projectId: "<?=FireBase::PROJECT_ID?>",
    storageBucket: "<?=FireBase::STORAGE_BUCKET?>",
    messagingSenderId: "<?=FireBase::MESSAGING_SENDER_ID?>"
  };

  firebase.initializeApp(config);
</script>