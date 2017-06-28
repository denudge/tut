<template>
  <tr class="editor_table_row">
    <td>Ein Eintrag</td>
    <td>Datum</td>
    <td>Start</td>
    <td>Ende</td>
  </tr>
</template>

<script>
export default {
  name: 'EditorTableRow',
  data () {
    return {
      rowData: [ 1, 2, 3 ]
    }
  }
}
</script>

<style>
tr.editor_table_row td {
  border: 1px solid #444;
  margin: 0px;
  padding: 2px 4px;
}
</style>
