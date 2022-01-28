<template>
    <div>
        <h1>Список категорий</h1>

        <clicker-component
            @clickerClicked="clickerClicked"
            name='clicker1'
            :customClass="clickerClass1"
        >
        </clicker-component>
        <br>
        <clicker-component
            @clickerClicked="clickerClicked"
            name='clicker2'
            :customClass="clickerClass2"
        >
        </clicker-component>

        <span v-if="showText" @click="showText = false">
            Some text
        </span>

        <h1>Здравствуйте, {{ fullName }} </h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Наименование</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, idx) in categories" :key="idx">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                </tr>
            </tbody>
        </table>

        <input v-model="name" @input="magic" class="form-control">
        {{name}}
        <br>
        {{ name ? name.split('').reverse().join('') : 'Строка пока что пустая' }}
        <br>
        {{ translitedName }}
        <br>
        {{ showTranslited() }}
        <br>
        {{ translited }}
        <br>
        <button @click='sayMyName' class="btn" :disabled="!isSuccess" :class="buttonClass">Назови мое имя</button>

        <br>

        <input v-model="checked" type="checkbox"> {{ checked }}

        <br>

        <input v-model="radioButton" type="radio" name="radioButton" value="1">
        <input v-model="radioButton" type="radio" name="radioButton" value="2">
        <input v-model="radioButton" type="radio" name="radioButton" value="3">
        {{ radioButton }}
        
        <select v-model="selectedValue" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>

        {{ selectedValue }}

    </div>
</template>

<script>
    import ClickerComponent from './ClickerComponent.vue'

    export default {
        props: [],
        components: {ClickerComponent},
        data () {
            return {
                categories: [
                    {
                        id: 1,
                        name: 'Процессоры'
                    },
                    {
                        id: 2,
                        name: 'Видеокарты'
                    },
                    {
                        id: 3,
                        name: 'Жесткие диски'
                    }
                ],
                showText: true,
                name: '',
                translitedName: '',
                firstName: 'Rail',
                lastName: 'Mingaliev',
                isSuccess: false,
                checked: true,
                radioButton: null,
                selectedValue: 2,
                clickerClass1: 'btn-primary',
                clickerClass2: 'btn-primary'
            }
        },
        computed: {
            buttonClass () {
                return this.isSuccess ? 'btn-success' : 'btn-info'
                console.log('!')
            },
            translited () {
                return this.translit(this.name)
            },
            fullName () {
                return this.firstName + ' ' + this.lastName
            }
        },
        watch: {
            selectedValue: (newValue, preValue) => {
                console.log(`новое значение: ${newValue}, старое значение: ${preValue}`)
            }
        },
        methods: {
            clickerClicked (payload) {
                if (payload.counter > 5) {
                    if (payload.name == 'clicker1') {
                        this.clickerClass1 = 'btn-success'
                    } else if (payload.name == 'clicker2') {
                        this.clickerClass2 = 'btn-danger'
                    }
                }
            },
            sayHello () {
                console.log('Hello')
            },
            sayMyName () {
                console.log("My name is " + this.name + '!')
                console.log(`My name is ${this.name}!`)
            },
            magic () {
                this.translitedName = this.translit(this.name)
                //this.name = answer
            },
            translit (word) {
                let converter = {
                ' ' : '',
                'q' : 'й', 'w' : 'ц', 'e' : 'у', 'r' : 'к', 't' : 'е', 'y' : 'н', 'u' : 'г', 'i' : 'ш', 'o' : 'щ','p' : 'з',
                '[' : 'х', ']' : 'ъ', 'a' : 'ф', 's' : 'ы', 'd' : 'в', 'f' : 'а', 'g' : 'п', 'h' : 'р', 'j' : 'о', 'k' : 'л',
                'l' : 'д', ';' : 'ж', "'" : 'э', 'z' : 'я', 'x' : 'ч', 'c' : 'с', 'v' : 'м', 'b' : 'и', 'n' : 'т', 'm' : 'ь', ',' : 'б', '.' : 'ю',
                'Q' : 'Й', 'W' : 'Ц', 'E' : 'У', 'R' : 'К', 'T' : 'Е', 'Y' : 'Н', 'U' : 'Г', 'I' : 'Ш', 'O' : 'Щ', 'P' : 'З',
                '{' : 'Х', '}' : 'Ъ', 'A' : 'Ф', 'S' : 'Ы', 'D' : 'В', 'F' : 'А', 'G' : 'П', 'H' : 'Р', 'J' : 'О', 'K' : 'Л',
                'L' : 'Д', ':' : 'Ж', '"' : 'Э', 'Z' : 'Я', 'X' : 'ч', 'C' : 'С', 'V' : 'М', 'B' : 'И', 'N' : 'Т', 'M' : 'Ь', '<' : 'Б', '>' : 'Ю',
                };
                let answer = ''
                for (let i = 0; i < word.length; ++i ) {
                    if (converter[word[i]] == undefined){
                        answer += word[i];
                    } else {
                        answer += converter[word[i]];
                    }
                }
                return answer
            },
            showTranslited () {
                return this.translit(this.name)
            }
        },
        mounted () {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>

</style>