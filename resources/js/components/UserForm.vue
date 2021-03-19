<script>
    import { BaseForm } from 'craftable';

    export default {
        name: "UserForm",
        mixins: [BaseForm],
        data: function () {
            return {
                form: {
                    name: '',
                    email: '',
                    email_verified_at: '',
                    password: '',

                },
                mediaCollections: ['userAvatar']
            }
        }
    }
</script>
