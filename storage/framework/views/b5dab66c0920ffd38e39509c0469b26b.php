<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-list-check me-2"></i>All Orders</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>User</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Collector</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><span class="badge bg-secondary">#<?php echo e($order->id); ?></span></td>
                        <td><i class="bi bi-person-circle me-1"></i><?php echo e($order->user->name); ?></td>
                        <td><i class="bi bi-geo-alt-fill me-1 text-danger"></i><?php echo e($order->location); ?></td>
                        <td>
                            <?php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'in_progress' => 'primary',
                                    'completed' => 'success',
                                    'assigned' => 'info'
                                ];
                                $color = $statusColors[$order->status] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?php echo e($color); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $order->status))); ?></span>
                        </td>
                        <td>
                            <?php if($order->collector): ?>
                                <span class="badge bg-info"><i class="bi bi-person-badge me-1"></i><?php echo e($order->collector->name); ?></span>
                            <?php else: ?>
                                <span class="text-muted fst-italic">Unassigned</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(!$order->collector_id): ?>
                                <form action="<?php echo e(route('admin.orders.assign', $order)); ?>" method="POST" class="d-flex gap-2">
                                    <?php echo csrf_field(); ?>
                                    <select name="collector_id" class="form-select form-select-sm" style="width: auto;" required>
                                        <option value="" selected disabled>Select collector</option>
                                        <?php $__currentLoopData = \App\Models\User::where('role','collector')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($collector->id); ?>"><?php echo e($collector->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-check-lg"></i> Assign
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted"><i class="bi bi-check-circle-fill text-success"></i> Assigned</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <?php echo e($orders->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\smart-waste-management\resources\views/admin/orders.blade.php ENDPATH**/ ?>