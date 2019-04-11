
<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($leaves as $leave): ?>
        <tr>
            <th scope="row"><?= $leave['id_user'];?></th>
            <td><?= $leave['name_user'];?></td>
            <td>
            <?php echo form_open('/chef/decline/'.$leave['id_conge']); ?>
                <input type="submit" value="Decline" class="btn btn-danger">
            </form>
            </td>
            <td><a href="accept/<?= $leave['id_conge'];?>" class="btn btn-success">Accept</a></td>
        </tr>
    <?php endforeach;?>
  </tbody>
</table>