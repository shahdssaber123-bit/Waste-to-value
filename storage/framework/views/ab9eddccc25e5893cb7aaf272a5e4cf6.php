<?php $__env->startSection('content'); ?>
<div class="text-center py-5">
    <h1 class="display-3 fw-bold" style="background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
        Smart Waste Management
    </h1>
    <p class="lead text-muted mb-4">Efficient waste collection for a cleaner, greener environment.</p>
    <?php if(auth()->guard()->guest()): ?>
        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-lg px-5 me-2">
            <i class="bi bi-person-plus me-2"></i>Get Started
        </a>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary btn-lg px-5">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </a>
    <?php else: ?>
        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary btn-lg px-5">
            <i class="bi bi-speedometer2 me-2"></i>Go to Dashboard
        </a>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\smart-waste-management\resources\views/user/welcome.blade.php ENDPATH**/ ?>