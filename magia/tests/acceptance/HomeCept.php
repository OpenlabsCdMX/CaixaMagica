<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Verificar si el Home es correcto');
$I->amOnPage("/");
$I->see("Hello World");
