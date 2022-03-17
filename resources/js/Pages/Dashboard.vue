
<template>
    <app-layout>
        <v-row>
          <v-col
            v-for="card in cards"
            :key="card"
            cols="12"
          >
            <v-card color="#0000B9" dark height='100%'>
            <div class="mt-5"></div>
              <v-subheader><h1>{{ card }}</h1></v-subheader>
              <v-card-text>
                <!-- <template>
                      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
        class="mb-5"
      ></v-text-field>
                    <v-data-table
                        :search="search"
                        :headers="headers"
                        :items="desserts"
                        :page.sync="page"
                        :items-per-page="itemsPerPage"
                        hide-default-footer
                        @page-count="pageCount = $event"
                        class="elevation-1"
                    >
                        <template slot="item.actions" slot-scope="props">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteItem(item)"
                            >
                                mdi-delete
                            </v-icon>
                        </template>
                            <template v-slot:item.fat="{ item }">
                            <v-chip
                              :color="getColorforFat(item.fat)"
                              dark
                            >
                              {{ item.fat }}
                            </v-chip>
                          </template>
                          <template v-slot:item.protein="{ item }">
                            <v-chip
                              :color="getColorforProtein(item.protein)"
                              dark
                            >
                              {{ item.protein }}
                            </v-chip>
                          </template>
                          <template v-slot:item.iron="{ item }">
                            <v-chip
                              :color="getColorforIron(item.iron)"
                              dark
                            >
                              {{ item.iron }}
                            </v-chip>
                          </template>
                          <template v-slot:item.carbs="{ item }">
                            <v-chip
                              :color="getColorforCarbs(item.carbs)"
                              dark
                            >
                              {{ item.carbs }}
                            </v-chip>
                          </template>
                    </v-data-table>
                </template>
                <div class="text-center pt-2">
                <v-pagination
                    v-model="page"
                    :length="pageCount"
                    circle
                    :total-visible="7"
                ></v-pagination>
                </div> -->
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
                  class="mb-5"
                ></v-text-field>
                  <v-data-table
                  :headers="headers"
                  :search="search"
                  :items="items"
                  sort-by="name"
                  class="elevation-1"
                  :page.sync="page"
                  :items-per-page="itemsPerPage"
                  hide-default-footer
                  @page-count="pageCount = $event"
                >
                  <template v-slot:top>
                    <v-toolbar
                      flat
                    >
                      <!-- <v-toolbar-title>My CRUD</v-toolbar-title>
                      <v-divider
                        class="mx-4"
                        inset
                        vertical
                      ></v-divider> -->
                      <v-spacer></v-spacer>
                      <v-dialog
                        v-model="dialog"
                        max-width="500px"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                          >
                            New Item
                          </v-btn>
                        </template>
                        <v-card>
                          <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                                <v-col
                                  cols="12"
                                  sm="6"
                                  md="4"
                                >
                                  <v-text-field
                                    v-model="editedItem.id"
                                    label="OCN"
                                  ></v-text-field>
                                </v-col>
                                <v-col
                                  cols="12"
                                  sm="6"
                                  md="4"
                                >
                                  <v-text-field
                                    v-model="editedItem.name"
                                    label="Employee Name"
                                  ></v-text-field>
                                </v-col>
                                <v-col
                                  cols="12"
                                  sm="6"
                                  md="4"
                                >
                                <v-combobox
                                v-model="editedItem.manaer"
                                      :items="choices"
                                      label="MANAER"
                                      outlined
                                      dense
                                      rounded
                                ></v-combobox>
                                </v-col>
                                <v-col
                                  cols="12"
                                  sm="6"
                                  md="4"
                                >
                                <v-combobox
                                v-model="editedItem.basic"
                                          :items="choices"
                                          label="BASIC"
                                          outlined
                                          dense
                                          rounded
                                ></v-combobox>
                                </v-col>
                                <v-col
                                  cols="12"
                                  sm="6"
                                  md="4"
                                >
                                <v-combobox
                                v-model="editedItem.tnr"
                                          :items="choices"
                                          label="TNR"
                                          outlined
                                          dense
                                          rounded
                                ></v-combobox>
                                </v-col>
                                <v-col
                                  cols="12"
                                  sm="6"
                                  md="4"
                                >
                                <v-combobox
                                v-model="editedItem.scan"
                                          :items="choices"
                                          label="SCAN"
                                          outlined
                                          dense
                                          rounded
                                ></v-combobox>
                                </v-col>
                              </v-row>
                            </v-container>
                          </v-card-text>

                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="close"
                            >
                              Cancel
                            </v-btn>
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="save"
                            >
                              Save
                            </v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                      <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                          <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                    </v-toolbar>
                  </template>
                  <template v-slot:item.actions="{ item }">
                    <v-icon
                      small
                      class="mr-2"
                      @click="editItem(item)"
                    >
                      mdi-pencil
                    </v-icon>
                    <v-icon
                      small
                      @click="deleteItem(item)"
                    >
                      mdi-delete
                    </v-icon>
                  </template>
                  <template v-slot:no-data>
                    <v-btn
                      color="primary"
                      @click="initialize"
                    >
                      Reset
                    </v-btn>
                  </template>
                    <template v-slot:item.manaer="{ item }">
                      <v-chip
                        :color="getColorforFat(item.manaer)"
                        dark
                      >
                        {{ item.manaer }}
                      </v-chip>
                    </template>
                    <template v-slot:item.tnr="{ item }">
                      <v-chip
                        :color="getColorforProtein(item.tnr)"
                        dark
                      >
                        {{ item.tnr }}
                      </v-chip>
                    </template>
                    <template v-slot:item.scan="{ item }">
                      <v-chip
                        :color="getColorforIron(item.scan)"
                        dark
                      >
                        {{ item.scan }}
                      </v-chip>
                    </template>
                    <template v-slot:item.basic="{ item }">
                      <v-chip
                        :color="getColorforCarbs(item.basic)"
                        dark
                      >
                        {{ item.basic }}
                      </v-chip>
                    </template>
                </v-data-table>
                <div class="text-center pt-2">
                <v-pagination
                    v-model="page"
                    :length="pageCount"
                    circle
                    :total-visible="7"
                ></v-pagination>
                </div>
                </v-card-text>
            </v-card>
          </v-col>
        </v-row>
    </app-layout>
</template>

<script>
    import AppLayout from '../Layouts/AppLayout'
    export default {
        components: {
            AppLayout,
        },
            data: () => ({
      choices : ['✓','N/A'],
      cards: ['Certification Tracking Table'],
              page: 1,
        pageCount: 0,
        itemsPerPage: 10,
      drawer: null,
      dialog: false,
      search: '',
      editedIndex: -1,
      editedItem: {
        id: '',
        name: '',
        manaer: 'N/A',
        basic: 'N/A',
        tnr: 'N/A',
        scan: 'N/A',
      },
      defaultItem: {
        id: '',
        name: '',
        manaer: 'N/A',
        basic: 'N/A',
        tnr: 'N/A',
        scan: 'N/A',
      },
      dialogDelete: false,
      links: [
        ['mdi-inbox-arrow-down', 'Inbox'],
        ['mdi-send', 'Send'],
        ['mdi-delete', 'Trash'],
        ['mdi-alert-octagon', 'Spam'],
      ],
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        search : '',
        headers: [],
                items: [
          {
            id: '2034456',
            name: 'Ricky Jamison',
            manaer: '✓',
            basic: 'N/A',
            tnr: '✓',
            scan: 'N/A',
          },
          {
            id: '441265',
            name: 'John Doe',
            manaer: '✓',
            basic: '✓',
            tnr: '✓',
            scan: 'N/A',
          },
          {
            id: '993456',
            name: 'Jordan Maxson',
            manaer: 'N/A',
            basic: 'N/A',
            tnr: '✓',
            scan: 'N/A',
          },
          {
            id: '546789',
            name: 'Connie Ringor',
            manaer: 'N/A',
            basic: 'N/A',
            tnr: 'N/A',
            scan: 'N/A',
          },
          {
            id: '10213',
            name: 'Jimmy Falcon',
            manaer: '✓',
            basic: '✓',
            tnr: '✓',
            scan: '✓',
          },
          {
            id: '345564',
            name: 'Larma Beiber',
            manaer:'✓',
            basic: '✓',
            tnr: 'N/A',
            scan: 'N/A',
          },
          {
            id: '787841',
            name: 'Delmar Rios',
            manaer: '✓',
            basic: 'N/A',
            tnr: 'N/A',
            scan: '✓',
          },
          {
            id: '513322',
            name: 'Ringar Mayo',
            manaer: 'N/A',
            basic: 'N/A',
            tnr: 'N/A',
            scan: '✓',
          },
          {
            id: '333456',
            name: 'Kobe Santos',
            manaer: '✓',
            basic:'✓',
            tnr:'✓',
            scan: '✓',
          },
          {
            id: '564631',
            name: 'Terrence Mardgeer',
            manaer: '✓',
            basic: 'N/A',
            tnr: 'N/A',
            scan: '✓',
          },
          {
            id: '446545',
            name: 'Tim Lassiter',
            manaer: '✓',
            basic: '✓',
            tnr: '✓',
            scan: '✓',
          },
        ],
    }),

    created: function(){
        this.getInitialData();
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

        methods: {

          getInitialData() {

              axios.get('/certificationData')
              .then(response =>{
                this.headers = response.data
                console.log(response.data)
              })
              .catch(error =>{
              console.log(error.response);
              })

          },
          getColorforFat (calories) {
            if (calories == 'N/A') return 'red'
            else return 'green'
          },
          getColorforCarbs (calories) {
            if (calories == 'N/A') return 'red'
            else return 'green'
          },
          getColorforProtein (calories) {
            if (calories == 'N/A') return 'red'
            else return 'green'
          },
          getColorforIron (calories) {
            if (calories == 'N/A') return 'red'
            else return 'green'
          },
                editItem (item) {
        this.editedIndex = this.items.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.items.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.items.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.items[this.editedIndex], this.editedItem)
        } else {
          this.items.push(this.editedItem)
        }
        this.close()
      },
        },
    }
</script>

<style>
.stick{
    position: sticky;
}
.color_for_text{
    color: #0000B9 !important;
}
.color_for_card_text{
   color: #0000B9;
}

</style>
