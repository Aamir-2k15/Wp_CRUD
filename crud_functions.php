<?php

add_action('wp_ajax_create_article', 'create_article');
add_action('wp_ajax_nopriv_create_article', 'create_article');

function create_article()
{
    $user_ID = get_current_user_id();
    $my_post = array();
    $my_post['post_title'] = $_REQUEST['title'];
    $my_post['post_content'] = $_REQUEST['body'];
    $my_post['post_status'] = 'publish';
    $my_post['post_author'] = $user_ID;
    $my_post['post_type'] = 'article';
// $my_post['post_category'] = array(0);
    // Insert the post into the database
    wp_insert_post($my_post);

    $status = 1;
    $message = "Record added successfully";
    echo json_encode(array('Status' => $status, 'MSG' => $message));
    exit;
}
//////////////////////
add_action('wp_ajax_get_all_records', 'get_all_records');
add_action('wp_ajax_nopriv_get_all_records', 'get_all_records');

function get_all_records()
{
    $args = array(
        'post_type' => 'article',
        'order_by' => 'ID',
        'order' => 'DESC',
    );
    $result = new WP_Query($args);


    if ($result->have_posts()):
        while ($result->have_posts()):
            $result->the_post();
            $n = 1;
            $records[] = "";
            ob_start();
            ?><tr id="<?php echo $n; ?>">

								    <td scope="row"><?php echo the_ID(); ?></td>
								    <td><?php the_title();?></td>
								    <td id="row_body"><?php echo substr(get_the_excerpt(), 0, 90) . '...'; ?></td>
								    <td>
								        <a href="javascript:void(0)" class="btn btn-outline-secondary view" title="View" data-id="<?php the_ID();?>">
								        <i class="fas fa-eye"></i>
								        </a>

								        <a href="javascript:void(0)" class="btn btn-outline-primary edit" title="Edit" data-id="<?php the_ID();?>">
								        <i class="fas fa-pencil-square-o" aria-hidden="true"></i>
								        </a>

								        <a href="javascript:void(0)" class="btn btn-outline-danger delete" title="Delete" data-id="<?php the_ID();?>">
								            <i class="fas fa-trash" aria-hidden="true"></i>
								        </a>
								    </td>
								</tr>
								<?php
        $record = ob_get_clean();
            $records[] .= $record;
            $n++;
        endwhile;
    endif;
    $status = 1;
    $message = "1";
    echo json_encode(array('Status' => $status, 'MSG' => $message, 'records' => $records));
    exit();
}

add_action('wp_ajax_read_article', 'read_article');
add_action('wp_ajax_nopriv_read_article', 'read_article');

function read_article()
{
    $p_id = $_REQUEST['id'];
    $args = array(
        'post_type' => 'article',
        'p' => $p_id,
        'order' => 'DESC',
    );
    $result = new WP_Query($args);

    if ($result->have_posts()):
        while ($result->have_posts()):

            $result->the_post();

            $title = get_the_title();
            $body = get_the_excerpt();

        endwhile;
    endif;
    wp_reset_postdata();
    $status = 1;
    $message = "1";
    echo json_encode(array('Status' => $status, 'MSG' => $message, 'id' => $p_id, 'title' => $title, 'body' => $body));
    exit();
}

add_action('wp_ajax_update_article', 'update_article');
add_action('wp_ajax_nopriv_update_article', 'update_article');

function update_article()
{
// print_r($_REQUEST); exit;
    $post = get_post($_REQUEST['id']);
    $post->post_title = $_REQUEST['title'];
    $post->post_content = $_REQUEST['body'];

    wp_update_post($post);

    $status = 1;
    $message = "Record updated successfully";
    echo json_encode(array('Status' => $status, 'MSG' => $message));
    exit;
}

add_action('wp_ajax_delete_article', 'delete_article');
add_action('wp_ajax_nopriv_delete_article', 'delete_article');

function delete_article()
{
    wp_delete_post($_REQUEST['id']);

    $status = 1;
    $message = "Record deleted successfully";
    echo json_encode(array('Status' => $status, 'MSG' => $message));
    exit;
}
