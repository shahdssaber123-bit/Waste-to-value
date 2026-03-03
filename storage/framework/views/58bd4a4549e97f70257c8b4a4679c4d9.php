<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-transparent border-0 pt-4 text-center">
                <h3 class="fw-bold"><i class="bi bi-plus-circle-fill me-2" style="color: #667eea;"></i>New Waste Collection Request</h3>
                <p class="text-muted">Fill in the details below</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('user.orders.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="location" class="form-label"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>Location</label>
                        <input type="text" class="form-control form-control-lg <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="location" name="location" value="<?php echo e(old('location')); ?>" required placeholder="Enter full address">
                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"><i class="bi bi-pencil-square me-1"></i>Description</label>
                        <textarea class="form-control form-control-lg <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description" name="description" rows="3" required placeholder="Describe the waste type, quantity, etc."><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-4">
                        <label for="scheduled_date" class="form-label"><i class="bi bi-calendar-event me-1"></i>Scheduled Date (optional)</label>
                        <input type="date" class="form-control form-control-lg" id="scheduled_date" name="scheduled_date" value="<?php echo e(old('scheduled_date')); ?>">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check2-circle me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\smart-waste-management\resources\views/user/create-order.blade.php ENDPATH**/ ?>