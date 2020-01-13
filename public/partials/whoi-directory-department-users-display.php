<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.whoi.edu
 * @since      1.0.0
 *
 * @package    Whoi_Directory_Search
 * @subpackage Whoi_Directory_Search/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="whoi-directory-search-results">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th> <th>Position</th> <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($users) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><a href="/profile/<?php echo $user->username ?>/"><?php echo $user->first_name ?> <?php echo $user->last_name ?></a></td>
                        <td><?php echo $user->hr_job_title ?></td>
                        <td><?php echo $user->building ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<script type="text/javascript">

// remove localStorage items to clear any expired local search history
sessionStorage.removeItem('staffSearch');
sessionStorage.removeItem('searchDept');

</script>
