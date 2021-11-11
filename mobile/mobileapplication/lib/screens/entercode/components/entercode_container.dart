import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/components/rounded_input_field.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_event.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_state.dart';

var _textEnterCode;

class EnterCodeContainer extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      margin: const EdgeInsets.symmetric(vertical: 10),
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      width: size.width,
      child: _Body(),
    );
  }
}

class _Body extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Column(
      children: <Widget>[
        SizedBox(
          width: size.width,
          child: Container(
            padding: const EdgeInsets.symmetric(vertical: 10),
            child: const Text(
              "Playing a game?",
              textAlign: TextAlign.left,
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.bold,
                color: Colors.black87,
              ),
            ),
          ),
        ),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 5, vertical: 5),
          decoration: BoxDecoration(
            color: const Color(0xFFF2F2F2),
            border: Border.all(color: const Color(0xFFE6E6E6), width: 2),
            borderRadius: BorderRadius.circular(10),
          ),
          child: _Form(),
        ),
        _NotificationResponse(),
      ],
    );
  }
}

class _Form extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Column(
          children: <Widget>[
            _Input(),
            _Button(),
          ],
        ),
      ],
    );
  }
}

class _Input extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return RoundedInputField(
      hintText: "Enter a game code",
      onChanged: (value) {
        _textEnterCode = value;
      },
    );
  }
}

class _Button extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return BlocBuilder<EnterCodeBloc, EnterCodeState>(
      builder: (context, state) {
        return RoundedButton(
          text: 'Join a game',
          isLoading: state is EnterCodeStateLoading,
          press: () {
            print(_textEnterCode);
            if (_textEnterCode != null) {
              BlocProvider.of<EnterCodeBloc>(context)
                  .add(EnterCodeSumitted(_textEnterCode.toString().trim()));
            }
          },
        );
      },
    );
  }
}

// Notification or Navigation to Wait Room Page
class _NotificationResponse extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return BlocBuilder<EnterCodeBloc, EnterCodeState>(
      builder: (context, state) {
        if (state is EnterCodeStateSuccess) {
          return SizedBox(
            width: size.width,
            child: Container(
              margin: const EdgeInsets.symmetric(vertical: 15),
              padding: const EdgeInsets.symmetric(vertical: 10),
              decoration: BoxDecoration(
                color: Colors.red,
                borderRadius: BorderRadius.circular(10),
              ),
              child: Text(
                state.checkIdRoomResponse.message,
                textAlign: TextAlign.center,
                style: const TextStyle(
                  fontSize: 15,
                  color: Colors.white,
                ),
              ),
            ),
          );
        }
        return Container();
      },
    );
  }
}
