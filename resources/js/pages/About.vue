<script setup>
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="À propos" />
    <main class="about-page">
        <!-- Présentation -->
        <section id="presentation" aria-labelledby="presentation-title">
            <header>
                <h1 id="presentation-title">À propos de moi</h1>
                <h2>Bonjour, moi c'est Antoine !</h2>
            </header>

            <p>
                Je m'appelle Antoine Mertens, j'ai 24 ans et je suis
                actuellement en formation de Web Developer à l'IFOSUP de Wavre.
            </p>

            <p>
                Mon parcours dans le monde du web a commencé par curiosité. Au
                départ, je voyais le développement comme une activité à
                découvrir, presque un passe-temps. Mais au fil de mes
                apprentissages, j'ai découvert un domaine passionnant qui me
                permet de développer ma créativité, ma logique et mes
                compétences techniques.
            </p>

            <p>
                Aujourd'hui, j'ai envie d'en faire mon métier et de continuer à
                progresser dans cet univers qui offre énormément de
                possibilités.
            </p>
        </section>

        <!-- Parcours -->
        <section id="parcours" aria-labelledby="parcours-title">
            <h2 id="parcours-title">Mon parcours</h2>

            <p>
                Après mes études secondaires à l'Athénée Royal de Jodoigne, où
                j'ai suivi une formation en tant que technicien de bureau, j'ai
                décidé d'explorer le domaine du numérique.
            </p>

            <article>
                <h3>SJB Formation – Wavre</h3>
                <p>
                    J'ai suivi une formation d'un an consacrée à la découverte
                    des métiers du web, notamment le développement et le design.
                </p>
            </article>

            <article>
                <h3>IFOSUP – Wavre</h3>
                <p>
                    Je poursuis actuellement mon apprentissage en développement
                    web, avec une approche principalement axée sur la
                    programmation, tout en découvrant les aspects visuels du
                    web.
                </p>
            </article>

            <article>
                <h3>Mon expérience en entreprise</h3>
                <p>
                    J'ai également effectué un stage de trois mois durant lequel
                    j'ai réalisé un site web pour un client. À cette époque, mes
                    connaissances en HTML et CSS étaient encore limitées, mais
                    j'ai pris en charge le projet dans son ensemble : du design
                    à la création d'éléments vectoriels, jusqu'au développement
                    du site.
                </p>

                <p>
                    Une expérience enrichissante qui m'a permis de découvrir les
                    réalités d'un projet web et de mettre en pratique mes
                    premières connaissances.
                </p>
            </article>
        </section>

        <!-- Compétences -->
        <section id="competences" aria-labelledby="competences-title">
            <h2 id="competences-title">Mes compétences</h2>

            <p>
                Au cours de ma formation, j'ai pu découvrir et pratiquer
                plusieurs technologies :
            </p>

            <article>
                <h3>Langages de programmation</h3>
                <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>PHP</li>
                    <li>JavaScript</li>
                    <li>SQL</li>
                </ul>
            </article>

            <article>
                <h3>Frameworks</h3>
                <ul>
                    <li>Laravel</li>
                    <li>Vue.js</li>
                </ul>
            </article>

            <article>
                <h3>Outils</h3>
                <ul>
                    <li>GitHub</li>
                    <li>Visual Studio Code</li>
                    <li>Figma</li>
                    <li>MySQL</li>
                </ul>
            </article>

            <article>
                <h3>Assistants IA</h3>
                <ul>
                    <li>ChatGPT</li>
                    <li>Claude</li>
                    <li>GitHub Copilot</li>
                </ul>
            </article>

            <p>
                Je continue à développer mes compétences et à découvrir de
                nouvelles technologies au fil de mes projets.
            </p>
        </section>

        <!-- Projets -->
        <section id="projets" aria-labelledby="projets-title">
            <h2 id="projets-title">Mes projets</h2>

            <p>
                J'ai déjà eu l'occasion de travailler sur différents projets,
                principalement dans le cadre de ma formation.
            </p>

            <article>
                <h3>Site de restaurant</h3>
                <p>
                    Création d'un site web pour un restaurant fictif, réalisé en
                    collaboration avec deux autres étudiants.
                </p>
            </article>

            <article>
                <h3>Site WordPress</h3>
                <p>
                    Réalisation d'un site WordPress dans le cadre d'un exercice
                    avec un client.
                </p>
            </article>

            <article>
                <h3>Jeux en JavaScript</h3>
                <p>
                    Développement de plusieurs petits jeux : Memory, Snake et
                    Morpion.
                </p>
            </article>

            <article>
                <h3>Jeu en Laravel</h3>
                <p>
                    Création d'un petit jeu au tour par tour, jouable
                    directement dans la console.
                </p>
            </article>
        </section>

        <!-- Personnalité et loisirs -->
        <section id="personnalite" aria-labelledby="personnalite-title">
            <h2 id="personnalite-title">
                Ma personnalité et mes centres d'intérêt
            </h2>

            <p>
                Je me considère comme quelqu'un de curieux, persévérant,
                autonome et ponctuel. J'aime comprendre comment les choses
                fonctionnent, découvrir de nouveaux sujets et relever des défis.
            </p>

            <article>
                <h3>Musique</h3>
                <p>
                    J'écoute des styles très différents, allant d'Evanescence à
                    BTS, en passant par Beethoven et Johnny Hallyday.
                </p>
            </article>

            <article>
                <h3>Mangas et animes</h3>
                <p>
                    J'apprécie particulièrement des univers comme One Piece et
                    Bleach.
                </p>
            </article>

            <article>
                <h3>Jeux vidéo</h3>
                <p>
                    J'aime découvrir différents genres de jeux, notamment Clair
                    Obscur, Persona 5 et League of Legends.
                </p>
            </article>

            <article>
                <h3>Histoire</h3>
                <p>
                    Je m'intéresse particulièrement à la mythologie, aux outils,
                    aux systèmes de défense, aux armes et aux grandes
                    inventions.
                </p>
            </article>
        </section>

        <!-- Objectifs -->
        <section id="objectifs" aria-labelledby="objectifs-title">
            <h2 id="objectifs-title">Mes objectifs</h2>

            <p>
                Mon objectif actuel est de consolider mes connaissances et de me
                spécialiser progressivement dans un langage ou une technologie.
            </p>

            <p>
                Par la suite, j'aimerais élargir mes compétences, découvrir de
                nouveaux outils et explorer différentes possibilités dans le
                monde du développement.
            </p>

            <p>
                À plus long terme, j'aimerais évoluer vers un profil de
                développeur Full-Stack.
            </p>

            <p>
                J'aime également me lancer des petits défis personnels, comme
                imaginer et développer un jeu vidéo en partant de zéro.
            </p>

            <p>
                Pour moi, le développement est un domaine dans lequel on ne
                cesse jamais d'apprendre, et c'est justement ce qui me plaît !
            </p>
        </section>

        <!-- Recherche de stage -->
        <section id="stage" aria-labelledby="stage-title">
            <h2 id="stage-title">À la recherche d'un stage !</h2>

            <p>
                Je suis actuellement à la recherche d'un stage d'une durée
                minimale de trois semaines dans le domaine du développement web.
            </p>

            <p>
                Mon objectif principal est de rejoindre une équipe dans laquelle
                je pourrai apprendre, progresser et découvrir les réalités du
                métier.
            </p>

            <p>
                Je recherche avant tout un environnement convivial et
                bienveillant, où le partage de connaissances, les conseils et
                l'entraide ont leur place.
            </p>

            <p>
                Je suis ouvert au présentiel, au télétravail ou à une formule
                hybride. Les horaires peuvent être discutés afin de trouver un
                arrangement adapté aux deux parties.
            </p>

            <p>
                Je souhaite avant tout profiter de cette expérience pour
                développer mes compétences, gagner en expérience et en
                autonomie.
            </p>

            <p>
                Et si cette collaboration devait déboucher sur une opportunité
                professionnelle par la suite, je serais bien évidemment ouvert à
                cette possibilité !
            </p>

            <footer>
                <p>
                    Vous recherchez un stagiaire motivé, curieux et prêt à
                    apprendre ?
                </p>

                <a href="mailto:mertensantoine07@gmail.com"> Me contacter </a>
            </footer>
        </section>
    </main>
</template>
