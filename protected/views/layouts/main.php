<?php /* @var $this Controller */ ?>
<?php
	$nextLanguage = $this->nextLanguage();
	$orderBadge = '';
	if ($this->newOrders) $orderBadge = '<span class="badge">+'.$this->newOrders.'</span>';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<!-- <div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div> -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu', [
			'items' => [
				[ 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index'] ],

				[ 'label' => Yii::t('app', 'Countries'), 'url' => ['/country/admin'], 'visible' => !Yii::app()->user->isGuest ],
				[ 'label' => Yii::t('app', 'Oblasts'), 'url' => ['/oblast/admin'], 'visible' => !Yii::app()->user->isGuest ],
				[ 'label' => Yii::t('app', 'Indicators'), 'url' => ['/indicator/admin'], 'visible' => !Yii::app()->user->isGuest ],
				[ 'label' => Yii::t('app', 'Settings'), 'url' => ['/settings/admin'], 'visible' => !Yii::app()->user->isGuest ],
				[ 'label' => Yii::t('app', 'Orders') . $orderBadge, 'url' => ['/order/admin'], 'visible' => !Yii::app()->user->isGuest, 'encodeLabel' => false ],

				[ 'label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'visible' => Yii::app()->user->isGuest, 'itemOptions' => ['class' => 'right'] ],
				[ 'label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => ['class' => 'right'] ],

				[ 'label' => $nextLanguage['text'], 'url' => ['', 'language' => $nextLanguage['id']], 'itemOptions' => ['class' => 'right'] ],
			]
		]); ?>
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo Yii::t('app', 'Copyright &copy; 2019 by SIC ICWC.') ?><br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
