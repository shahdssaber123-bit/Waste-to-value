<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-truck me-2"></i>My Assigned Orders</h1>
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
                        <th>Action</th>
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
                            <?php if(in_array($order->status, ['assigned', 'in_progress'])): ?>
                                <form action="<?php echo e(route('collector.orders.update', $order)); ?>" method="POST" class="d-flex gap-2">
                                    <?php echo csrf_field(); ?>
                                    <select name="status" class="form-select form-select-sm" style="width: auto;">
                                        <option value="" selected disabled>Change status</option>
                                        <?php if($order->status == 'assigned'): ?>
                                            <option value="in_progress">Start (In Progress)</option>
                                        <?php elseif($order->status == 'in_progress'): ?>
                                            <option value="completed">Complete</option>
                                        <?php endif; ?>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-arrow-repeat"></i> Update
                                    </button>
                                </form>
                            <?php elseif($order->status == 'completed'): ?>
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Completed</span>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\smart-waste-management\resources\views/collector/orders.blade.php ENDPATH**/ ?>