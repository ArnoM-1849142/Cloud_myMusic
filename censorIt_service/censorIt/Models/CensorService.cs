using System.Text.RegularExpressions;

namespace Models {

    public class CensorService : ICensorService
    {
        //excuses voor het taalgebruik hieronder, maar dit was nodig om het realistisch te maken
        public string[] swearWords = new string[]{"shit", "fuck", "bitch","arse", "ass",
                                                "pussy", "dick", "prick", "cunt", "cock", "slut", "whore", "nigga", "nigger"};
        public string censorSwearing(string text){
            string censoredText = text;
            foreach (string word in swearWords){
                string replacementWord = new string ('*', word.Length);
                censoredText = Regex.Replace(censoredText, word, replacementWord, RegexOptions.IgnoreCase);
            }
            return censoredText;
        }

        public string replaceSwearing(string text, string replacement){
            string censoredText = text;
            foreach (string word in swearWords){
                censoredText = Regex.Replace(censoredText, word, replacement, RegexOptions.IgnoreCase);
            }
            return censoredText;
        }

        public string replaceWordForWord(string text, string word, string newWord){
            string censoredText = Regex.Replace(text, word, newWord);
            return censoredText;
        }
    }
}