<?php if(isset($html_error)): ?>
<?php echo $html_error; ?>
<?php endif; ?>
<p>brmファイル読み込み</p>
<?php echo Form::open('/confirm'); ?>
<p>
	<?php echo Form::label('ファイル', 'brmfile'); ?>
	<?php echo Form::file('brmfile'); ?>
</p>
<p>
	<?php echo Form::reset('reset','取り消し'); ?><?php echo Form::submit('submit', '送信'); ?>
</p>
<?php echo Form::close(); ?>
