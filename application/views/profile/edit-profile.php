<!-- Start Hero Section -->
<div class="hero1">
    <div class="container">
        <div class="col-lg-5">
            <div class="intro-excerpt">
                <h1><?= $title; ?></h1>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-sectionn">
    <div class="container">
        <form action="<?= base_url('profile/updateprofile') ?>" method="POST">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Profile</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <?php foreach ($users as $user) : ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>">
                            <input type="hidden" name="old_password" value="<?php echo $user->password; ?>">
                            <input type="hidden" name="old_profile_image" value="<?php echo $user->profile_image; ?>">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="profile_image" class="text-black">Foto Profile</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="username" class="text-black">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $user->username; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="email" class="text-black">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user->email; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="text-black">Password</label>
                                    <input type="text" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Simpan</button>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Foto Profile Kamu</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <?php if ($user->profile_image == 'default.png') : ?>
                                    <img src="<?= base_url('assets/images/' . $user->profile_image); ?>" alt="<?= $user->profile_image; ?>" width="400">
                                <?php else : ?>
                                    <img src="<?= base_url('assets/img/upload/' . $user->profile_image); ?>" alt="<?= $user->profile_image; ?>" width="400">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

            </div>
        </form>
        <!-- </form> -->
    </div>
</div>