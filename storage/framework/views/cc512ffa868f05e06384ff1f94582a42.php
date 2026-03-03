<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3"><i class="bi bi-people-fill me-2" style="color: #667eea;"></i>Manage Users</h1>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-success btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Add New User
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-4"><span class="badge bg-secondary">#<?php echo e($user->id); ?></span></td>
                                <td>
                                    <i class="bi bi-person-circle me-2" style="color: #667eea;"></i>
                                    <?php echo e($user->name); ?>

                                </td>
                                <td>
                                    <i class="bi bi-envelope me-2 text-muted"></i>
                                    <?php echo e($user->email); ?>

                                </td>
                                <td>
                                    <?php
                                        $roleColors = [
                                            'admin' => 'danger',
                                            'collector' => 'info',
                                            'user' => 'primary',
                                        ];
                                        $color = $roleColors[$user->role] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?php echo e($color); ?> px-3 py-2">
                                        <i
                                            class="bi bi-<?php echo e($user->role == 'admin' ? 'shield-lock' : ($user->role == 'collector' ? 'truck' : 'person')); ?> me-1"></i>
                                        <?php echo e(ucfirst($user->role)); ?>

                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn btn-sm btn-warning me-2"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?php echo e($users->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\smart-waste-management\resources\views/admin/users.blade.php ENDPATH**/ ?>