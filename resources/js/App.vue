<template>
    <div class="ortaDiv page">
        <div class="row">
            <!-- Mezunlar -->
            <div v-if="!isLoading" class="medium-9 columns content">
                <h3 class="anaTitle" id="page-title">{{ students.length }} Mezun</h3>

                <!-- /slider -->
                <div class="gridSistem">

                    <!-- Mezun genel açıklama text -->
                    <div class="row">
                        <div  class="medium-12 columns left" >
                            <div style="position: relative;">
                                <div  class="blok gridHtml b-lazy" style="height:60px; ">
                                    <h4 style="display:none;">Bilgisayar Mühendisliği</h4 >
                                    <div class="textIcerik" id="stil522" style="color: black;">
                                        <p>
                                            Lisans eğitimini Özyeğin Üniversitesi
                                            <strong>Bilgisayar Mühendisliği</strong>
                                            bölümünde tamamlayan mezunlarımızın güncel başarı hikayelerini bu sayfadan sizlerle paylaşmaya devam edeceğiz.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="students.length > 0">
                        <Student v-for="student in students" :student="student"/>
                    </div>

                </div>

                <!-- /grid -->
                <div class="block " data-bid="1892">
                </div>
            </div>

            <!-- Sağ Menü-->
            <div class="medium-3 columns sagMenu">

                <div class="block " data-bid="704">
                    <h4 >Bilgisayar Mühendisliği</h4>
                    <div class="menu-block-wrapper menu-block-54 menu-name-menu-mf-bilgisayar-muhendisligi parent-mlid-0 menu-level-2">
                        <ul class="menu"><li class="first leaf menu-mlid-1088 hakk-nda mid-1088"><a href="/tr/bilgisayar-muhendisligi/hakkinda">Hakkında</a></li>
                            <li class="leaf menu-mlid-6057 akademik-kadro mid-6057"><a href="/tr/bilgisayar-muhendisligi/akademik-kadro">Akademik Kadro</a></li>
                            <li class="leaf menu-mlid-1089 ara-t-rma mid-1089"><a href="/tr/bilgisayar-muhendisligi/arastirma">Araştırma</a></li>
                            <li class="expanded menu-mlid-6024 lisans-e-itimi-b-sc-program- mid-6024"><span class="nolink" tabindex="0">Lisans Eğitimi (B. Sc. Programı)</span><ul class="menu"><li class="first leaf menu-mlid-1760 program-hakk-nda mid-1760"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/program-hakkinda">Program Hakkında</a></li>
                                <li class="leaf menu-mlid-1477 ders-plan- mid-1477"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/ders-plani">Ders Planı</a></li>
                                <li class="leaf menu-mlid-10409 a-lan-dersler mid-10409"><a href="https://www.ozyegin.edu.tr/tr/acilan-dersler?program=BSCS">Açılan Dersler</a></li>
                                <li class="leaf menu-mlid-1755 id-n-ko-ul-diyagram- mid-1755"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/kosul-diyagrami">Ön Koşul Diyagramı</a></li>
                                <li class="leaf menu-mlid-1476 ders-erikleri mid-1476"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/ders-icerikleri">Ders İçerikleri</a></li>
                                <li class="leaf menu-mlid-1761 id-ap-ve-yandal mid-1761"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/cap-ve-yandal">ÇAP ve YANDAL</a></li>
                                <li class="leaf menu-mlid-1475 mezuniyet-y-k-ml-l-kleri mid-1475"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/mezuniyet-yukumlulukleri">Mezuniyet Yükümlülükleri</a></li>
                                <li class="last leaf menu-mlid-7920 uzmanl-k-alanlar- mid-7920"><a href="/tr/bilgisayar-muhendisligi/lisans-egitimi-b-sc-programi/ozellesilen-alanlar-uzmanlik-alanlari">Uzmanlık Alanları</a></li>
                            </ul></li>
                            <li class="leaf menu-mlid-6025 lisans-st-e-itimi-m-sc-ve-ph-d-programlar- mid-6025"><a href="https://www.ozyegin.edu.tr/tr/bilgisayar-muhendisligi-yuksek-lisans">Lisansüstü Eğitimi (M.Sc. ve Ph.D. Programları)</a></li>
                            <li class="leaf menu-mlid-6942 duyurular mid-6942"><a href="/tr/bilgisayar-muhendisligi/duyurular">Duyurular</a></li>
                            <li class="leaf menu-mlid-9054 id-ba-vurular- mid-9054"><a href="/tr/bilgisayar-muhendisligi/basvurulari">İş Başvuruları</a></li>

                            <!-- Mezun sayısı -->
                            <li v-if="!isLoading" class="last leaf active-trail active menu-mlid-13683 id3-mezun mid-13683">
                                <a href="/tr/bilgisayar-muhendisligi/3-mezun" class="active-trail active">
                                {{ students.length }} / {{ totalStudent }} Mezun
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="message" style="display: none;">

                </div>
            </div>

            <!-- /sidebar-first -->
        </div>
        <!-- Subcomponent -->
        <div class="row" style="display:block;">

        </div>
    </div>

</template>

<script setup>

import {onMounted, ref} from "vue";
import axios from 'axios';
import Student from "./components/Student.vue"

let students = ref([])
let totalStudent = ref(null)
let isLoading = ref(true)

function loadStudents() {
    isLoading.value = true

    axios.get("/students")
        .then((response) => {
            students.value = response.data.students;
            totalStudent.value = response.data.totalStudent;
            console.log(response.data.students);
        })
        .catch(() => console.error("Failed loading students."))
        .finally(() => isLoading.value = false)
}

onMounted(function () {
    loadStudents()
})
</script>

<style>
.gridSistem .row .columns .blok #stil522.listIcerik, .gridSistem .row .columns .blok #stil522.listIcerik ul, .gridSistem .row .columns .blok #stil522.listIcerik ul li, .gridSistem .row .columns .blok #stil522.listIcerik a, .gridSistem .row .columns .blok #stil522.listIcerik ul li a,.gridSistem .row .columns .blok #stil522.textIcerik, .gridSistem .row .columns .blok #stil522.textIcerik strong,.gridSistem .row .columns .blok #stil522.textIcerik span, .gridSistem .row .columns .blok #stil522.textIcerik p, .gridSistem .row .columns .blok #stil522.textIcerik ul, .gridSistem .row .columns .blok #stil522.textIcerik ul li, .gridSistem .row .columns .blok #stil522.textIcerik a {
  color: black !important;
}

.gridSistem .row .columns .blok #stil515.listIcerik, .gridSistem .row .columns .blok #stil515.listIcerik ul, .gridSistem .row .columns .blok #stil515.listIcerik ul li, .gridSistem .row .columns .blok #stil515.listIcerik a, .gridSistem .row .columns .blok #stil515.listIcerik ul li a,.gridSistem .row .columns .blok #stil515.textIcerik, .gridSistem .row .columns .blok #stil515.textIcerik strong,.gridSistem .row .columns .blok #stil515.textIcerik span, .gridSistem .row .columns .blok #stil515.textIcerik p, .gridSistem .row .columns .blok #stil515.textIcerik ul, .gridSistem .row .columns .blok #stil515.textIcerik ul li, .gridSistem .row .columns .blok #stil515.textIcerik a {
  color: black !important;
}

.ortaDiv .content ul li {padding: 8px 0;}
.gridSistem .row .columns .blok.gridNewsList .haberListe ul li  {padding: 0;}

</style>
