<h2>Available Logs</h2>
<ul>
<?php foreach ($files as $file): ?>
    <li><a href="<?php echo site_url('logcontroller/view/' . $file); ?>"><?php echo $file; ?></a></li>
<?php endforeach; ?>
</ul>
