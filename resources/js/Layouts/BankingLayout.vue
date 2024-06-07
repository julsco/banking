<template>
    <div class="">
        <q-layout view="hHh Lpr lff" container style="height: 100vh" class="shadow-2 rounded-borders">
<!--            <q-header elevated :class="$q.dark.isActive ? 'bg-secondary' : 'bg-black'">-->
<!--                <q-toolbar>-->
<!--                    <i class="fa-solid fa-bars cursor-pointer" @click="drawer = !drawer"/>-->
<!--                    <q-toolbar-title>Banking</q-toolbar-title>-->
<!--                </q-toolbar>-->
<!--            </q-header>-->

            <q-drawer
                v-model="drawer"
                show-if-above

                :mini="miniState"
                @mouseover="miniState = false"
                @mouseout="miniState = true"

                :width="200"
                :breakpoint="500"
                bordered
                :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'"
            >
                <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
                    <q-list padding>
                        <div v-for="(navItem, i) in mainNavItems" :key="i">
                            <q-item clickable v-ripple @click="$inertia.visit(navItem.href)"
                                    :active="activePage(navItem.href)">
                                <q-item-section avatar>
                                    <i class="fa-solid cursor-pointer" :class="navItem.icon"/>
                                </q-item-section>

                                <q-item-section>
                                    {{ navItem.title }}
                                </q-item-section>
                            </q-item>
                        </div>

                        <q-separator />

                        <!-- Utility icons -->
                        <div v-for="(navItem, i) in utilityNavItems" :key="i">
                            <q-item clickable v-ripple @click="$inertia.visit(navItem.href)"
                                    :active="activePage(navItem.href)">
                                <q-item-section avatar>
                                    <i class="fa-solid cursor-pointer" :class="navItem.icon"/>
                                </q-item-section>

                                <q-item-section>
                                    {{ navItem.title }}
                                </q-item-section>
                            </q-item>
                        </div>

                        <!-- Logout -->
                        <q-item clickable v-ripple @click="logout">
                            <q-item-section avatar>
                                <i class="fa-solid fa-right-from-bracket cursor-pointer"/>
                            </q-item-section>

                            <q-item-section>Logout</q-item-section>
                        </q-item>
                    </q-list>
                </q-scroll-area>
            </q-drawer>

            <q-page-container>
                <q-page padding>
                    <slot/>
                </q-page>
            </q-page-container>
        </q-layout>
    </div>
</template>

<script>
import { router } from "@inertiajs/vue3";

export default {
    name: 'BankingLayout',
    data() {
        return {
            drawer: false,
            miniState: true,
            currentUrl: this.$page.url,
            mainNavItems: [
                {
                    title: 'Dashboard',
                    icon: 'fa-house',
                    href: '/dashboard',
                },
                {
                    title: 'Bank Accounts',
                    icon: 'fa-building-columns',
                    href: '/bank-accounts',
                },
                {
                    title: 'Team Dashboard',
                    icon: 'fa-people-group',
                    href: '/team-dashboard',
                }
            ],
            utilityNavItems: [
                {
                    title: 'Settings',
                    icon: 'fa-gear',
                    href: '/user/profile',
                },
            ],
        };
    },
    methods: {
        logout() {
            router.post(route('logout'));
        },
        activePage(href) {
            return this.$page.url === href;
        },
        setUserVariables() {
            this.$store.commit('userVariables/setUser', this.user);
        },
    },
    computed: {
        user() { return this.$page.props.auth.user; },
        currentTeam() { return this.user.current_team; },
    },
    created() {
        this.setUserVariables();
    },
    watch: {
        user: function() {
            this.$store.commit('userVariables/setUser', this.user);
        },
        currentTeam: function(){
            this.$store.commit('userVariables/setCurrentTeam', this.currentTeam);
        },
    },
}
</script>
