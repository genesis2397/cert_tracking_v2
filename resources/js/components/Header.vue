<template>
  <v-app-bar app elevate-on-scroll elevation="3" color="#0000B9" dark>
      <v-app-bar-nav-icon @click="$emit('handleDrawer')"></v-app-bar-nav-icon>
            <v-toolbar-title class='toolbar_title'><img :src="require('../../../public/images/daisho_png.png').default" style="width:200px; height:auto; cursor:pointer;"></v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
  </v-app-bar>
  </template>

  <style>
      .toolbar_title{
         font-weight: bold;
      }
  </style>
