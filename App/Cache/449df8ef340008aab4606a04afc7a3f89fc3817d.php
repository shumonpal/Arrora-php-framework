<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
<h1>Wellcome</h1>
<h3>This is view from 'Category' controller.</h3>
	<ul>
		<?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
        	<p><?php echo e($cat['name']); ?></p>
        	<p><?php echo e($cat['discribe']); ?></p>
        </li>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<h3><?php echo e(hello()); ?></h3>
</body>
</html>