import AppForm from '../app-components/Form/AppForm';

Vue.component('article-form', {
    mixins: [AppForm],
    data: function () {
        return {
            form: {
                name: '',
                description: '',
                article_type_id: '',
                articleType: [],
                publish: false,
            },
            mediaCollections: ['articleImage']
        }
    },
});
