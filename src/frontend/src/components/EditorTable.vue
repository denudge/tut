<template>
  <div class="editor_table">
    <table cellspacing="0" cellpadding="0">
      <editor-table-row></editor-table-row>
      <editor-table-row></editor-table-row>
      <editor-table-row></editor-table-row>
    </table>
  </div>
</template>

<script>
import EditorTableRow from '@/components/EditorTableRow'

export default {
  name: 'EditorTable',
  data () {
    return {
      selectedEntry: null,
      rows: []
    }
  },
  components: { EditorTableRow }
}
</script>
