<?php

try {
    HZip::zipDir(BASE_PATH."/server/pages/ddd", BASE_PATH."/server/pages/test/answer.zip");
} catch (Exception) {
    echo "error";
}
